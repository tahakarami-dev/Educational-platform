<main class="main-content">
    <div class="card">
        <div class="card-body">

            {{-- Create User --}}
            <div class="card mb-4">
                <div class="card-body">
                    <h6 class="card-title">ایجاد کاربر</h6>

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="saveUser">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">نام و نام خانوادگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" wire:model.defer="name">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">ایمیل</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" wire:model.defer="email">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">پسورد</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" wire:model.defer="password">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">آپلود عکس</label>
                            <div class="col-sm-10">
                                <input type="file" wire:model="image">
                                <div wire:loading wire:target="image" class="text-info mt-1">
                                    در حال آپلود...
                                </div>
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success"
                                wire:loading.attr="disabled">
                            ذخیره
                        </button>
                    </form>
                </div>
            </div>

            {{-- Search --}}
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">جستجو</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" wire:model.live="search"
                           placeholder="نام، ایمیل یا موبایل">
                </div>
            </div>

            {{-- Users Table --}}
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>عکس</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>موبایل</th>
                        <th>وضعیت</th>
                        <th>تاریخ ایجاد</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <img width="40" height="40" class="rounded-circle"
                                     src="{{ $user->image
                                        ? asset('storage/users/'.$user->image)
                                        : asset('admin/default-avatar.png') }}">
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td></td>
                            <td>
                                <span class="badge badge-success">فعال</span>
                            </td>
                            <td>{{ $user->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            </div>

        </div>
    </div>
</main>
