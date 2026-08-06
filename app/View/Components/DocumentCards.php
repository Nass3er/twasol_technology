<?php

namespace App\View\Components;

use App\Models\Post; // Assuming you are passing a Post model or similar structure
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\File; // Import the File facade for size checking
use Illuminate\View\Component;

class DocumentCards extends Component
{
    /**
     * The post object containing media and detail relationships.
     * @var \App\Models\Post
     */
    public $post;

    /**
     * The formatted file size.
     * @var string|null
     */
    public $formattedSize = null;

    /**
     * Create a new component instance.
     *
     * @param mixed $post The post model instance to display.
     */
    public function __construct($post)
    {
        $this->post = $post;
        
        // Calculate and set the formatted size immediately
        if (isset($post->mediaOne->link) && $post->mediaOne->link != '') {
            $filePath = public_path($post->mediaOne->link);
            if (File::exists($filePath)) {
                $this->formattedSize = $this->formatSize(File::size($filePath));
            }
        }
    }

    /**
     * Formats the size of a file in bytes to a human-readable format (KB, MB, GB).
     *
     * @param int $bytes
     * @return string
     */
    protected function formatSize($bytes): string
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . '<span class="text-rose-900">GB</span>';
        }
        if ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . '<span class="text-rose-900">MB</span>';
        }
        if ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . '<span class="text-rose-900">KB</span>';
        }
        if ($bytes > 1) {
            return $bytes . '<span class="text-rose-900">bytes</span>';
        }
        if ($bytes == 1) {
            return $bytes . '<span class="text-rose-900">byte</span>';
        }
        return '0<span class="text-rose-900">bytes</span>';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.document-cards');
    }
}
