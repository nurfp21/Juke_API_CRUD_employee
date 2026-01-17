<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Employee_model');
        header('Content-Type: application/json');
    }

    private function input_json() {
        return json_decode(file_get_contents('php://input'), true);
    }

    private function send_response($data, $status = 200) {
        http_response_code($status);
        echo json_encode($data);
        exit;
    }

    public function index() {
        $data = $this->Employee_model->get_all();
        $this->send_response($data);
    }

    public function show($id) {
        $data = $this->Employee_model->get_by_id($id);
        if (!$data) {
            $this->send_response(['message' => 'Employee not found'], 404);
        }
        $this->send_response($data);
    }

    public function store() {
        $input = $this->input_json();

        if (empty($input['name']) || empty($input['email'])) {
            $this->send_response(['message' => 'Name and Email are required'], 400);
        }

        if ($input['salary'] <= 0) {
            $this->send_response(['message' => 'Salary must be greater than 0'], 400);
        }

        if ($this->Employee_model->is_email_exists($input['email'])) {
            $this->send_response(['message' => 'Email already exists'], 400);
        }

        $id = $this->Employee_model->insert($input);
        $new_data = $this->Employee_model->get_by_id($id);
        $this->send_response($new_data, 201);
    }

    public function update($id) {
        $input = $this->input_json();
        $existing = $this->Employee_model->get_by_id($id);

        if (!$existing) {
            $this->send_response(['message' => 'Employee not found'], 404);
        }

        if (isset($input['email']) && $this->Employee_model->is_email_exists($input['email'], $id)) {
            $this->send_response(['message' => 'Email already taken'], 400);
        }

        $this->Employee_model->update($id, $input);
        $this->send_response(['message' => 'Employee updated successfully']);
    }

    public function delete($id) {
        $existing = $this->Employee_model->get_by_id($id);
        if (!$existing) {
            $this->send_response(['message' => 'Employee not found'], 404);
        }

        $this->Employee_model->delete($id);
        $this->send_response(['message' => 'Employee deleted']);
    }
}
?>