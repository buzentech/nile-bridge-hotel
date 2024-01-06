<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['title'] = "Home";
        $data['name'] = "Home";
        $data['desc'] = $this->seo_description;
        $data['img'] = $this->seo_image;
        $data['route'] = current_url();

        echo view('frontend/lib/header', $data);
        echo view('frontend/home/index', $data);
        echo view('frontend/lib/footer', $data);
    }

    public function gallery()
    {
        $data['title'] = 'Gallery';
        $data['name'] = "Gallery";
        $data['desc'] = $this->seo_description;
        $data['img'] = $this->seo_image;
        $data['route'] = current_url();

        echo view('frontend/lib/header', $data);
        echo view('frontend/home/gallery', $data);
        echo view('frontend/lib/footer', $data);
    }

    # SendContactMail
    public function SendContactMail()
    {
        $response = array();
        if ($this->request->getMethod() === 'post') {
            #validate input
            $rules = [
                'name' => 'trim|required',
                'subject' => 'trim|required',
                'email' => 'trim|required|valid_email',
                'message' => 'trim|required',
            ];

            if (!$this->validation->setRules($rules)->run($this->request->getPost())) {
                $response['validation'] = $this->validation->listErrors();
                $response['success'] = 0;
                $response['message'] = $this->validation->listErrors();

                echo json_encode($response);
            } else {
                $name = $this->homeModel->cleanString($this->request->getPost('name'));
                $subject = $this->homeModel->cleanString($this->request->getPost('subject'));
                $email = $this->homeModel->cleanString($this->request->getPost('email'));
                $message = $this->homeModel->cleanString($this->request->getPost('message'));

                $result = $this->homeModel->SendMailNotification($subject, $email, $name, $message);
                if ($result) {
                    $response['success'] = 1;
                    $response['message'] = "Successfully Sent Mail";
                    echo json_encode($response);
                } else {
                    $response['success'] = 0;
                    $response['message'] = "Unable to send Mail";
                    echo json_encode($response);
                }
            }
        }
        else{
            $response['success'] = 0;
            $response['message'] = "Missing Parameter(s)";

            echo json_encode($response);
        }
    }

}
