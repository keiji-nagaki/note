<!-- resources/views/tweet/create.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('タスク登録') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('task.store') }}" method="POST">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="task" :value="__('内容')" />
              <x-text-input id="task" class="block mt-1 w-full" type="text" name="task" :value="old('task')" required autofocus />
              <x-input-error :messages="$errors->get('task')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="deadline" :value="__('期限')" />
              <x-text-input id="deadline" class="block mt-1 w-full" type="date" name="deadline" :value="old('deadline')" required autofocus />
              <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
            </div>
         
             
            <div class="flex items-center justify-end mt-4">
              <x-primary-button class="ml-3">
                {{ __('登録') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

