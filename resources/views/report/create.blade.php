<!-- resources/views/tweet/create.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('報告書登録') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('report.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col mb-4">
              <x-input-label for="maker" :value="__('施工会社')" />
              <x-text-input id="maker" class="block mt-1 w-full" type="text" name="maker" :value="old('maker')" required autofocus />
              <x-input-error :messages="$errors->get('maker')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="year" :value="__('点検年')" />
              <x-text-input id="year" class="block mt-1 w-full" type="text" name="year" :value="old('year')" required autofocus />
              <x-input-error :messages="$errors->get('year')" class="mt-2" />
            </div><div class="flex flex-col mb-4">
              <x-input-label for="report" :value="__('報告書')" />
              <x-text-input id="report" class="block mt-1 w-full" type="file" name="report" :value="old('report')" required autofocus />
              <x-input-error :messages="$errors->get('report')" class="mt-2" />
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

