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

    public $name;
    public $email;
    public $mobile;
    public $password;
    public $image;
    public $search = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'mobile' => 'nullable|string|max:20',
        'password' => 'required|min:6',
        'image' => 'nullable|image|max:2048',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query()
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.admin.user.user-list', compact('users'))
            ->layout('admin.master');
    }

    public function saveuser()
    {
        $this->validate();

        $imageName = null;

        if ($this->image) {
            $imageName = time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('users', $imageName, 'public');
        }

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => Hash::make($this->password),
            'image' => $imageName,
        ]);

        $this->reset(['name', 'email', 'mobile', 'password', 'image']);

        session()->flash('message', 'کاربر جدید با موفقیت ایجاد شد');
    }
}
