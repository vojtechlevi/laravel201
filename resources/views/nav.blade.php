<nav class="bg-slate-300 py-4">
    <div class="max-w-7x1 mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class=" text-green-400">
                   {{'Welcome '.session('user_name').'!'}}
                </h1>
            </div>
            <div>
                <ul class="flex space-x-4">
                    <li><a href="/dashboard" class="text-white hover:text-gray-200">Your Cars</a></li>
                    <li><a href="/add" class="text-white hover:text-gray-200">Add Car</a></li>
                    <li><a href="/account" class="text-white hover:text-gray-200">Account</a></li>
                    <li><a href="/logout" class="text-white hover:text-gray-200">Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
