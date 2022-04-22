<x-new-layout>
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
          <div class="bg-gradient-primary text-white shadow-primary border-radius-lg pt-4 pb-3 px-3 d-flex align-items-center justify-content-between">
            <h6 class="text-capitalize ps-3 text-white">Users Management</h6>
            <a class="btn btn-warning ps-3  " href="{{route('admin.user.create')}}">create new user</a>
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name/Email</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Account Type</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">LRN</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Level</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Strand</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                @foreach (\App\Models\User::get() as $user)
                <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                          <img src="{{$user->getPicture()}}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$user->name}}</h6>
                          <p class="text-xs text-secondary mb-0">{{$user->email}}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                        {{$user->type ?? 'N/a'}}
                    </td>
                    <td>
                        {{$user->number ?? 'N/a'}}
                    </td>
                    <td class="align-middle text-center text-sm">
                      {{$user->level ?? 'N/a'}}
                    </td>
                    <td class="align-middle text-center">
                      {{$user->strand ?? 'N/a'}}
                    </td>
                    <td class="align-middle">
                      <a href="{{route('admin.user.edit', ['user' => $user->id])}}" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        Edit
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
</x-new-layout>
