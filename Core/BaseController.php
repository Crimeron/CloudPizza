<?php
namespace Core;
class BaseController extends Starter
{
    public function view($view, $data = [])
    {
        $viewFile = __DIR__ . '/../App/views/' . $view . '.php';

        if (file_exists($viewFile)) {
            extract($data);
            require $viewFile;
        } else {
            die("Görüntü dosyası bulunamadı: " . $view);
        }
    }
    public function adminview($view, $data = [])
    {
        $viewFile = __DIR__ . '/../App/views/admin/' . $view . '.php';

        if (file_exists($viewFile)) {
            extract($data);
            require $viewFile;
        } else {
            die("Görüntü dosyası bulunamadı: " . $view);
        }
    }
}
