<?php

namespace App\Livewire\Blog;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ListingBlog extends Component
{
    use WithPagination;

    // Synchronisés avec l'URL (?categorie=…&tag=…) — except: '' évite le paramètre vide
    #[Url(as: 'categorie', except: '')]
    public string $categorie = '';

    #[Url(as: 'tag', except: '')]
    public string $tag = '';

    public function updatedCategorie(): void { $this->resetPage(); }
    public function updatedTag(): void       { $this->resetPage(); }

    public function filtrerCategorie(string $categorie): void
    {
        $this->categorie = $this->categorie === $categorie ? '' : $categorie;
        $this->resetPage();
    }

    public function filtrerTag(string $tag): void
    {
        $this->tag = $this->tag === $tag ? '' : $tag;
        $this->resetPage();
    }

    public function reinitialiser(): void
    {
        $this->reset(['categorie', 'tag']);
        $this->resetPage();
    }

    #[Computed]
    public function aucunFiltre(): bool
    {
        return $this->categorie === '' && $this->tag === '';
    }

    public function render(): \Illuminate\View\View
    {
        $query = Article::publie()->latest('published_at');

        if ($this->categorie !== '') {
            $query->whereJsonContains('categories', $this->categorie);
        }

        if ($this->tag !== '') {
            $query->whereJsonContains('tags', $this->tag);
        }

        return view('livewire.blog.listing-blog', [
            'articles'   => $query->paginate(9),
            'categories' => Article::toutesCategories(),
            'tags'       => Article::tousTags(),
            'locale'     => app()->getLocale(),
        ]);
    }
}
