<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
         $data['title'] = "Home";
        // $data['name'] = $this->sitename;
        // $data['desc'] = $this->seo_description;
        // $data['img'] = $this->seo_image;
        // $data['route'] = current_url();

        // $data['stories'] = $this->storiesModel->where('b_status', 'Active')->orderBy('b_no','desc')->findAll();

         echo view('frontend/lib/header', $data);
         echo view('frontend/home/index', $data);
         echo view('frontend/lib/footer', $data);
    }

    public function gallery()
    {
        $data['title'] = 'Gallery';
        // $data['name'] = $this->sitename;
        // $data['desc'] = $this->seo_description;
        // $data['img'] = $this->seo_image;
        // $data['route'] = current_url();

        echo view('frontend/lib/header', $data);
        echo view('frontend/home/gallery', $data);
        echo view('frontend/lib/footer', $data);
    }

}
