@extends('layouts.admin')

@section('title', 'Clasificaciones (Tipos y Tags)')

@push('head')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700&display=swap" rel="stylesheet">

<style>
  .font-display{ font-family: Manrope, sans-serif; }
</style>
@endpush

@section('content')
@php
  $types = [
    ['name'=>'Annual Report', 'status'=>'Active', 'meta'=>'Created Jan 10, 2024 • System Default', 'deletable'=>false],
    ['name'=>'Financial Statement', 'status'=>'Active', 'meta'=>'Created Feb 14, 2024 • Restricted', 'deletable'=>true],
    ['name'=>'Field Survey', 'status'=>'Active', 'meta'=>'Created Mar 22, 2024', 'deletable'=>true],
    ['name'=>'Project Proposal', 'status'=>'Draft',  'meta'=>'Created Jun 05, 2024', 'deletable'=>true],
    ['name'=>'Meeting Minutes', 'status'=>'Active', 'meta'=>'Created Aug 12, 2024', 'deletable'=>true],
  ];

  $tags = [
    ['name'=>'Education',         'category'=>'Program Area',     'usage'=>'234 docs', 'dot'=>'bg-blue-500'],
    ['name'=>'Cusco Region',      'category'=>'Location',         'usage'=>'156 docs', 'dot'=>'bg-purple-500'],
    ['name'=>'Health Initiatives','category'=>'Program Area',     'usage'=>'98 docs',  'dot'=>'bg-green-500'],
    ['name'=>'Q3-2023',           'category'=>'Reporting Period', 'usage'=>'45 docs',  'dot'=>'bg-orange-500'],
    ['name'=>'Urubamba',          'category'=>'Location',         'usage'=>'32 docs',  'dot'=>'bg-indigo-500'],
    ['name'=>'Environment',       'category'=>'Program Area',     'usage'=>'12 docs',  'dot'=>'bg-teal-500'],
  ];
@endphp

<div class="font-display min-h-screen">
  {{-- Top Navigation (si tu layout ya tiene header, puedes borrar este bloque) --}}
  <header class="bg-white dark:bg-surface-dark border-b border-gray-200 dark:border-gray-800 sticky top-0 z-30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16">
        <div class="flex items-center gap-4">
          <div class="flex-shrink-0 flex items-center gap-2">
            <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-lg">N</div>
            <span class="font-bold text-lg tracking-tight">NGO Docs</span>
          </div>
          <div class="hidden md:flex items-center text-sm text-gray-400">
            <span class="material-icons text-base mx-2">chevron_right</span>
            <span>Settings</span>
            <span class="material-icons text-base mx-2">chevron_right</span>
            <span class="text-gray-800 dark:text-gray-100 font-medium">Classifications</span>
          </div>
        </div>

        <div class="flex items-center gap-4">
          <button class="p-2 text-gray-400 hover:text-primary transition-colors rounded-full hover:bg-primary/10" type="button">
            <span class="material-icons">notifications</span>
          </button>
          <div class="flex items-center gap-2">
            <div class="h-8 w-8 rounded-full bg-slate-200 dark:bg-slate-700 border-2 border-primary/20"></div>
            <span class="text-sm font-medium hidden sm:block">Admin User</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  {{-- Main --}}
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- Page Header --}}
    <div class="md:flex md:items-center md:justify-between mb-8">
      <div class="min-w-0 flex-1">
        <h1 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:truncate sm:text-3xl sm:tracking-tight">
          System Configuration
        </h1>
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
          Manage document types and descriptive tags to organize the NGO's knowledge base.
        </p>
      </div>
      <div class="mt-4 flex md:ml-4 md:mt-0">
        <button class="inline-flex items-center rounded-lg bg-white dark:bg-surface-dark px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-100 shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors" type="button">
          <span class="material-icons text-sm mr-2">history</span>
          View Audit Log
        </button>
      </div>
    </div>

    {{-- Dashboard Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
      {{-- Left: Document Types --}}
      <div class="lg:col-span-5 flex flex-col gap-6">
        <div class="bg-white dark:bg-surface-dark shadow-sm ring-1 ring-gray-900/5 dark:ring-white/10 rounded-xl overflow-hidden flex flex-col h-full">
          <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-white/5">
            <div>
              <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">Document Types</h3>
              <p class="text-xs text-gray-500 mt-1">Foundational categories for files.</p>
            </div>
            <button class="rounded-lg bg-primary px-3 py-2 text-xs font-semibold text-white shadow-sm hover:bg-primary-hover transition-all flex items-center" type="button">
              <span class="material-icons text-sm mr-1">add</span> New Type
            </button>
          </div>

          <div class="px-6 py-3 border-b border-gray-100 dark:border-gray-800 bg-white dark:bg-surface-dark">
            <div class="relative rounded-md shadow-sm">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="material-icons text-gray-400 text-sm">search</span>
              </div>
              <input class="block w-full rounded-lg border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm dark:bg-surface-dark dark:ring-gray-700 dark:text-white"
                     placeholder="Filter types..." type="text" />
            </div>
          </div>

          <ul class="divide-y divide-gray-100 dark:divide-gray-800 overflow-auto flex-1 max-h-[600px]" role="list">
            @foreach($types as $t)
              @php
                $isActive = $t['status'] === 'Active';
                $badge = $isActive
                  ? 'bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 ring-green-600/20'
                  : 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-800 dark:text-yellow-500 ring-yellow-600/20';
              @endphp

              <li class="flex items-center justify-between gap-x-6 py-4 px-6 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                <div class="min-w-0">
                  <div class="flex items-start gap-x-3">
                    <p class="text-sm font-semibold leading-6 text-gray-900 dark:text-white">{{ $t['name'] }}</p>
                    <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium ring-1 ring-inset {{ $badge }}">
                      {{ $t['status'] }}
                    </span>
                  </div>
                  <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                    <p class="truncate">{{ $t['meta'] }}</p>
                  </div>
                </div>

                <div class="flex flex-none items-center gap-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                  <button class="text-gray-400 hover:text-primary transition-colors" type="button">
                    <span class="material-icons text-lg">edit</span>
                  </button>
                  @if($t['deletable'])
                    <button class="text-gray-400 hover:text-red-600 transition-colors" type="button">
                      <span class="material-icons text-lg">delete</span>
                    </button>
                  @endif
                </div>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      {{-- Right: Tags --}}
      <div class="lg:col-span-7 flex flex-col gap-6">
        <div class="bg-white dark:bg-surface-dark shadow-sm ring-1 ring-gray-900/5 dark:ring-white/10 rounded-xl overflow-hidden flex flex-col h-full">
          <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/50 dark:bg-white/5">
            <div>
              <h3 class="text-base font-semibold leading-6 text-gray-900 dark:text-white">Metadata Tags</h3>
              <p class="text-xs text-gray-500 mt-1">Keywords for filtering and searching.</p>
            </div>
            <button class="rounded-lg bg-white dark:bg-surface-dark px-3 py-2 text-xs font-semibold text-gray-900 dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors flex items-center" type="button">
              <span class="material-icons text-sm mr-1 text-primary">sell</span> New Tag
            </button>
          </div>

          <div class="px-6 py-3 border-b border-gray-100 dark:border-gray-800 bg-white dark:bg-surface-dark flex gap-3">
            <div class="relative rounded-md shadow-sm flex-1">
              <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <span class="material-icons text-gray-400 text-sm">search</span>
              </div>
              <input class="block w-full rounded-lg border-0 py-1.5 pl-10 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm dark:bg-surface-dark dark:ring-gray-700 dark:text-white"
                     placeholder="Search tags..." type="text" />
            </div>

            <select class="block rounded-lg border-0 py-1.5 pl-3 pr-8 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm dark:bg-surface-dark dark:ring-gray-700 dark:text-white">
              <option>Most Used</option>
              <option>Alphabetical</option>
              <option>Newest</option>
            </select>
          </div>

          <div class="overflow-x-auto flex-1">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-800">
              <thead class="bg-gray-50 dark:bg-white/5">
                <tr>
                  <th class="py-3.5 pl-6 pr-3 text-left text-xs font-semibold text-gray-900 dark:text-white">Tag Name</th>
                  <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 dark:text-white">Category</th>
                  <th class="px-3 py-3.5 text-left text-xs font-semibold text-gray-900 dark:text-white">Usage</th>
                  <th class="relative py-3.5 pl-3 pr-6"><span class="sr-only">Actions</span></th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-800 bg-white dark:bg-surface-dark">
                @foreach($tags as $tag)
                  <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                    <td class="whitespace-nowrap py-4 pl-6 pr-3 text-sm font-medium text-gray-900 dark:text-white">
                      <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full {{ $tag['dot'] }}"></span>
                        {{ $tag['name'] }}
                      </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tag['category'] }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                      <span class="inline-flex items-center rounded-full bg-primary/10 px-2 py-1 text-xs font-medium text-primary ring-1 ring-inset ring-primary/20">
                        {{ $tag['usage'] }}
                      </span>
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-6 text-right text-sm font-medium">
                      <button class="text-gray-400 hover:text-primary transition-colors" type="button">
                        <span class="material-icons text-lg">more_vert</span>
                      </button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          <div class="border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-surface-dark px-4 py-3 sm:px-6">
            <nav aria-label="Pagination" class="flex items-center justify-between">
              <div class="hidden sm:block">
                <p class="text-sm text-gray-700 dark:text-gray-300">
                  Showing <span class="font-medium">1</span> to <span class="font-medium">6</span> of <span class="font-medium">24</span> tags
                </p>
              </div>
              <div class="flex flex-1 justify-between sm:justify-end gap-2">
                <button class="relative inline-flex items-center rounded-md bg-white dark:bg-surface-dark px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-white/10" type="button">Previous</button>
                <button class="relative inline-flex items-center rounded-md bg-white dark:bg-surface-dark px-3 py-2 text-sm font-semibold text-gray-900 dark:text-gray-200 ring-1 ring-inset ring-gray-300 dark:ring-gray-700 hover:bg-gray-50 dark:hover:bg-white/10" type="button">Next</button>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>

    {{-- Quick Stats --}}
    <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="bg-primary/5 rounded-xl p-6 border border-primary/10">
        <div class="flex items-center">
          <div class="p-3 rounded-lg bg-primary/20 text-primary">
            <span class="material-icons">description</span>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Documents</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">2,405</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-surface-dark rounded-xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm">
        <div class="flex items-center">
          <div class="p-3 rounded-lg bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
            <span class="material-icons">folder_open</span>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Active Types</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">12</p>
          </div>
        </div>
      </div>

      <div class="bg-white dark:bg-surface-dark rounded-xl p-6 border border-gray-200 dark:border-gray-800 shadow-sm">
        <div class="flex items-center">
          <div class="p-3 rounded-lg bg-purple-100 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
            <span class="material-icons">label</span>
          </div>
          <div class="ml-4">
            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Tags</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">24</p>
          </div>
        </div>
      </div>
    </div>
  </main>

  <div class="fixed top-0 left-0 w-full h-96 -z-10 bg-gradient-to-b from-primary/5 to-transparent pointer-events-none"></div>
</div>
@endsection
