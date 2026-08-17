<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Categories extends Component
{
    public string $name = '';
    public string $color = '#6366F1';
    public string $icon = 'folder';
    
    /**
     * =====================
     * Create Category
     * =====================
     */
    public function createCategory() : void {
        //validating inputs
        $validated = $this->validate([
            'name' => ['string', 'required', 'max:255'],
            'color' => ['string', 'required', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'icon' => ['string', 'required', 'max:50'],
        ]);
        //Creating category
        Category::create([
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'color' => $validated['color'],
            'icon' => $validated['icon'],
        ]);
        //reseting inputs
        $this->reset(['name',]);
        $this->color = '#6366F1';
        $this->icon = 'folder';

        session()->flash(
            'success',
            'Category created successfully'
        );

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Category created successfully'
        );
        $this->dispatch('category-created');
    }
    

    /**
     * ==============
     * render
     * ==============
     */
    public function render()
    {
        //finding categories of user
        $categories = Category::where('user_id', Auth::id())
            ->withCount('tasks')->latest()->get();
        return view('livewire.categories', [
            'categories' => $categories,
        ]);
    }
}