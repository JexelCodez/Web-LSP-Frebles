

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="flex items-center justify-center mt-4">
        <x-primary-button class="ms-3">
            <a href="{{ url('user/dashboard') }}">BACK FOR USER</a>
        </x-primary-button>

        @if(Auth::user()->usertype == 'admin')
            <x-primary-button class="ms-3">
                <a href="{{ url('admin/dashboard') }}">BACK FOR ADMIN</a>
            </x-primary-button>
        @else
            <x-primary-button class="ms-3" onclick="displayAdminOnlyMessage()">
                <a href="#">BACK FOR ADMIN</a>
            </x-primary-button>
        @endif
    </div> -->

</x-app-layout>

<!-- <script>
    function displayAdminOnlyMessage() {
        Swal.fire({
            icon: 'error',
            title: 'Admin Only',
            text: 'You need to be an admin to access this section.',
            confirmButtonText: 'OK'
        });
    }
</script> -->

