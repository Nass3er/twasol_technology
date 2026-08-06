namespace App\Http\Livewire;

use Livewire\Component;

class Carousel extends Component
{
    public $slides = [
        [
            'id' => 'slide1',
            'image' => 'https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp',
        ],
        [
            'id' => 'slide2',
            'image' => 'https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.webp',
        ],
        [
            'id' => 'slide3',
            'image' => 'https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.webp',
        ],
        [
            'id' => 'slide4',
            'image' => 'https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.webp',
        ],
    ];

    public function render()
    {
        return view('livewire.carousel');
    }
}
