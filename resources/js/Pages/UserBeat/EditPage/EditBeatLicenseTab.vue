<template>
    <div>
        <div class="mx-auto max-w-8xl px-5 lg:px-5">
            <div class="mx-auto max-w-2xl rounded-3xl ring-1 ring-gray-200 lg:mx-0 lg:flex lg:max-w-none">
                <div class="p-8 sm:p-10 lg:flex-auto">
                    <h3 class="text-3xl font-semibold tracking-tight text-gray-900">
                        Name
                    </h3>
                    <p class="mt-6 text-base text-gray-600">
                        Long description
                    </p>

                    <div class="mt-10 flex items-center gap-x-4">
                        <h4 class="flex-none text-sm font-semibold text-indigo-600">
                            What’s included
                        </h4>
                        <div class="h-px flex-auto bg-gray-100"></div>
                    </div>

                    <ul role="list" class="mt-8 grid grid-cols-3 gap-4 text-sm text-gray-600 sm:grid-cols-2 sm:gap-6">
                        <li class="flex gap-x-3 items-center">
                            <svg class="h-6 w-5 flex-none text-indigo-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                    clip-rule="evenodd" />
                            </svg>
                            Features
                        </li>
                    </ul>
                </div>

                <div class="-mt-2 p-2 lg:mt-0 lg:w-full lg:max-w-md lg:shrink-0">
                    <div
                        class="rounded-2xl bg-gray-50 py-10 text-center ring-1 ring-inset ring-gray-900/5 lg:flex lg:flex-col lg:justify-center lg:py-16">
                        <div class="mx-auto max-w-xs px-8">
                            <p class="text-base font-semibold text-gray-600">
                                Short description
                            </p>
                            <p class="mt-6 flex items-baseline justify-center gap-x-2">
                                <span class="text-5xl font-semibold tracking-tight text-gray-900">
                                    $Price
                                </span>
                                <span class="text-sm font-semibold tracking-wide text-gray-600">
                                    USD
                                </span>
                            </p>
                            <a href="#"
                                class="mt-10 block w-full rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                                Get access
                            </a>
                            <p class="mt-6 text-xs text-gray-600">
                                Download and read full license
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
