<!-- resources/views/tweet/edit.blade.php -->

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Tweet') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:w-8/12 md:w-1/2 lg:w-5/12">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-800 ">
          @include('common.errors')
          <form class="mb-6" action="{{ route('task.update',$task->id) }}" method="POST">
            @method('put')
            @csrf

            
            <div class="flex flex-col mb-4">
              <x-input-label for="task" :value="__('内容')" />
              <h3 class="text-left font-bold text-lg text-gray-dark dark:text-gray-200">{{$task->task}}</h3>
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="deadline" :value="__('期限')" />
              <x-text-input id="deadline" class="block mt-1 w-full" type="date" name="deadline" value="{{$task->deadline}}" autofocus />
              <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
            </div>
            <div class="flex flex-col mb-4">
              <x-input-label for="finish" :value="__('完了日')" />
              <x-text-input id="finish" class="block mt-1 w-full" type="date" name="finish" value="{{$task->finish}}" autofocus />
              <x-input-error :messages="$errors->get('finish')" class="mt-2" />
            </div>
            
            <div class="flex items-center justify-end mt-4">
              <a href="{{ url()->previous() }}">
                <x-secondary-button class="ml-3">
                  {{ __('Back') }}
                </x-primary-button>
              </a>
              <x-primary-button class="ml-3">
                {{ __('Update') }}
              </x-primary-button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>

