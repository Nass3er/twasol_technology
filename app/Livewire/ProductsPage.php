<?php

namespace App\Livewire;

use Livewire\Component;

class ProductsPage extends Component
{       
    public $product;
    public $pro=0;
    public function mount($product = null)
    {
        $this->product = $product;
    }

    public function showProductDetails($id)
    {
        // $productdetail = (object)   [
        //         'id' => '1',
        //         'pname' => 'اسمنت تشطيب',
        //         'pimage' => 'images/product3.png',
        //         'description' => 'أسمنت خاص بأعمال التشطيب والتشطيبات الداخلية والخارجية.',
        //         'specs' => ['يتماسك بسرعة.', 'قوة التصاق عالية.', 'مناسب لجميع أنواع الأسطح.'],
        //         'downloadLink' => '/files/تشطيب.pdf'
        //     ];
            $this->pro = ++$id;
        // $this->product = (object) $id;
    }
    public function render()
    {
        return view('livewire.products-page');
    }
}
