<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {
    private $filename = 'import_data';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_mahasiswa');

    }

    public function index()
    {
        $data = ['mahasiswa' => $this->model_mahasiswa->getAll()];
        $this->load->view('mahasiswa/index', $data);
    }

    public function form()
    {
        $data = [];

        if (isset($_POST['preview'])) {
            $upload = $this->upload_file($this->filename);

            if ($upload['result'] === "success") {
                include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

                $excelReader = new PHPExcel_Reader_Excel2007();

                $loadExcel = $excelReader->load('excel/' . $this->filename . '.xlsx');

                $sheet = $loadExcel->getActiveSheet()->toArray(null, true, true, true);

                $data['sheet'] = $sheet;
            } else {
                $data['upload_error'] = $upload['error'];
            }
        }

        $this->load->view('form', $data);
    }

    public function import()
    {
        include APPPATH . 'third_party/PHPExcel/PHPExcel.php';

        $excelReader = new PHPExcel_Reader_Excel2007();
        $loadExcel = $excelReader->load('excel/' . $this->filename .'.xlsx');

        $sheet = $loadExcel->getActiveSheet()->toArray(null, true, true, true);

        $data = [];

        $numRow = 1;
        foreach ($sheet as $row) {
            if ($numRow > 1) {
                array_push($data, [
                    'nim' => $row['A'],
                    'nama' => $row['B'],
                    'jenis_kelamin' => $row['C'],
                    'tempat_lahir' => $row['D'],
                    'tanggal_lahir' => $row['E'],
                    'alamat' => $row['F'],
                ]);
            }

            $numRow++;
        }

        $this->model_mahasiswa->insert_multiple($data);

        redirect('mahasiswa');

    }


    // Fungsi untuk melakukan proses upload file
    private function upload_file($filename)
    {
        $this->load->library('upload'); // Load librari upload

        $config['upload_path'] = './excel/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = '12048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
}