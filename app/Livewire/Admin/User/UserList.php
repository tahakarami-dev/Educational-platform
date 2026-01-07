<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UserList extends Component
{
    use WithPagination, WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $name;
    public $email;
    public $password;
    public $image;
    public $search = '';

    protected $rules = [
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'image'    => 'nullable|image|max:2048',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->where(function ($query) {
                $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%");
            })
            ->latest()
            ->paginate(10);

        return view('livewire.admin.user.user-list', compact('users'))
            ->layout('admin.master');
    }

    public function saveUser()
    {
        $this->validate();

        $imageName = null;

        if ($this->image) {
            $imageName = uniqid() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('users', $imageName, 'public');
        }

        User::create([
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => Hash::make($this->password),
            'image'    => $imageName,
        ]);

        $this->reset(['name', 'email', 'password', 'image']);

        session()->flash('message', 'کاربر جدید با موفقیت ایجاد شد');
    }
    public function deleteUser($userId){
        User::where('id', $userId)->delete();
        session()->flash('message', 'کاربر با موفقیت حذف شد');
    }
}
