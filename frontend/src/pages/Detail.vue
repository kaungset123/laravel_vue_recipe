<template>
    <header>
      <nav class="flex  justify-between items-center h-[80px] border-b xl:px-[80px] md:px-[50px] px-[20px]">
        <div>
          <router-link :to="{name: 'home'}" class="text-3xl text-green-400 font-semibold">My Recipe</router-link>
        </div>
        <div>
          <router-link :to="{name : 'form'}" class="px-3 py-3 rounded-lg bg-red-400 hover:opacity-[0.85] transition-all duration-500 text-white flex items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <div>Add Recipe</div>
          </router-link>
        </div>
      </nav>
    </header>
  
    <main class="flex gap-5 items-center md:flex-row flex-col xl:px-[80px] md:px-[50px] px-[20px] my-11">
      <img class="max-h-[400px] max-w-[400px] object-cover"  alt="product image" />
      <div class="space-y-5">
        <h5 class="text-4xl font-semibold tracking-tight text-gray-900 dark:text-white">
          recipe title
        </h5>
        <p class="text-gray-500">
          recipe description
        </p>
        <div class="flex gap-4 border-t py-5 justify-end">
          <router-link class="bg-blue-400 text-white px-4 py-2 rounded-lg">Edit</router-link>
          <button class="bg-red-500 text-white px-3 py-2 rounded-lg">Delete</button>
        </div>
      </div>
    </main>
  </template>