<template>
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <!-- Hero section - updated with indigo gradient -->
        <div class="relative mb-12">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-2xl"></div>
            <div class="relative text-center py-12 px-6">
                <h1 class="text-4xl font-bold text-white mb-4">How can we help you?</h1>
                <p class="text-lg text-indigo-100 max-w-2xl mx-auto">Find answers to common questions and learn how to make the most of our platform.</p>
            </div>
        </div>

        <!-- Search section - updated styling -->
        <div class="mb-12">
            <div class="max-w-xl mx-auto relative">
                <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                    <svg class="h-5 w-5 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input
                    type="search"
                    placeholder="Search for help..."
                    class="w-full pl-10 pr-4 py-4 border-2 border-indigo-100 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                />
            </div>
        </div>

        <!-- Quick links section - updated styling -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="p-8 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-indigo-50">
                <div class="flex items-center mb-4">
                    <svg class="h-6 w-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    <h2 class="text-xl font-semibold">Getting Started</h2>
                </div>
                <ul class="space-y-2">
                    <li><a href="#" class="text-blue-600 hover:underline">Quick Start Guide</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Basic Features</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Account Setup</a></li>
                </ul>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Popular Topics</h2>
                <ul class="space-y-2">
                    <li><a href="#" class="text-blue-600 hover:underline">Troubleshooting</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">FAQ</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Best Practices</a></li>
                </ul>
            </div>
            <div class="p-6 bg-white rounded-lg shadow">
                <h2 class="text-xl font-semibold mb-4">Support</h2>
                <ul class="space-y-2">
                    <li><a href="#" class="text-blue-600 hover:underline">Contact Support</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Submit Ticket</a></li>
                    <li><a href="#" class="text-blue-600 hover:underline">Community Forum</a></li>
                </ul>
            </div>
        </div>

        <!-- New: Popular Articles -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6">Popular Articles</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <article class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <span class="text-sm text-blue-600 font-semibold">Getting Started</span>
                    <h3 class="text-lg font-semibold mt-2 mb-2">How to Set Up Your Account</h3>
                    <p class="text-gray-600 mb-4">Learn the basics of setting up and configuring your account for optimal use.</p>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">Read More →</a>
                </article>
                <!-- Add 3 more similar article blocks -->
            </div>
        </div>

        <!-- New FAQ Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-8 text-indigo-900">Frequently Asked Questions</h2>
            <div class="space-y-4">
                <div v-for="(faq, index) in faqs" :key="index" class="border border-indigo-100 rounded-xl overflow-hidden">
                    <button
                        @click="faq.isOpen = !faq.isOpen"
                        class="w-full px-6 py-4 text-left bg-white hover:bg-indigo-50 transition-colors duration-200 flex justify-between items-center"
                    >
                        <span class="font-medium text-indigo-900">{{ faq.question }}</span>
                        <svg
                            class="w-5 h-5 text-indigo-500 transform transition-transform duration-200"
                            :class="{ 'rotate-180': faq.isOpen }"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <div
                        v-show="faq.isOpen"
                        class="px-6 py-4 bg-indigo-50 border-t border-indigo-100"
                    >
                        <p class="text-gray-700">{{ faq.answer }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Updated Contact section with indigo -->
        <div class="bg-gradient-to-r from-indigo-600 to-indigo-800 p-8 rounded-xl text-white">
            <div class="md:flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Still Need Help?</h2>
                    <p class="mb-4 md:mb-0 text-indigo-100">Our support team is available 24/7 to assist you with any questions.</p>
                </div>
                <div class="flex space-x-4">
                    <button class="bg-white text-indigo-600 px-6 py-3 rounded-lg hover:bg-indigo-50 transition-colors duration-300 font-semibold">
                        Contact Support
                    </button>
                    <button class="border-2 border-white text-white px-6 py-3 rounded-lg hover:bg-indigo-700 transition-colors duration-300 font-semibold">
                        Live Chat
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import Default from '../Layouts/Default.vue'
import { ref } from 'vue'

defineOptions({
    layout: Default
})

const faqs = ref([
    {
        question: "How do I reset my password?",
        answer: "You can reset your password by clicking the 'Forgot Password' link on the login page. You'll receive an email with instructions to create a new password.",
        isOpen: false
    },
    {
        question: "What payment methods do you accept?",
        answer: "We accept all major credit cards (Visa, MasterCard, American Express), PayPal, and bank transfers for business accounts.",
        isOpen: false
    },
    {
        question: "How can I cancel my subscription?",
        answer: "You can cancel your subscription at any time from your account settings. Navigate to Billing > Subscriptions and click the 'Cancel Subscription' button.",
        isOpen: false
    },
    {
        question: "Is there a mobile app available?",
        answer: "Yes! Our mobile app is available for both iOS and Android devices. You can download it from the App Store or Google Play Store.",
        isOpen: false
    }
])
</script>
