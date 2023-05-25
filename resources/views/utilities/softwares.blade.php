<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Software utilities
        </h2>
    </x-slot>

    <div x-data="{sampicsinfo: false}">
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mt-5">
                <p class="font-semibold text-2xl text-gray-800 leading-tight">SAMpics</p>
                <br>
                <p class="text-gray-600 leading-tight">SAMpics is an Android program to take and upload pictures on the SAM server, directly to your personal space </p>
            </div>
            <button @click="sampicsinfo = !sampicsinfo" class="mt-5 bg-gray-300 text-gray-500 py-2 px-4 rounded">Install info ...</button>
            <div x-show="sampicsinfo" class="block mt-5">
                <p class="text-gray-600 leading-tight text-justify">Connect to this page from your phone and press the "Download APK" button to install. You will have to allow the option "Allow installation of apps from unknown sources", in the settings of your phone.
                Upon installation, the application will require the permissions to use the camera and to save data on the phone (to save settings).
                    To configure the app, you have to enter the address (URL) of the SAM server, your username and password.
                    You must have defined your username in your profile. This will allow you to log in without using your email address, and is required to connect from
                    SAMpics -<i> Using the email will not work !</i> Alternatively, you could also download the APK file on your computer and transfer it by USB on your phone.
                </p>
            </div>
            <div class="block mt-8">
                <a href="/getsafefile/sampics/sampics.apk" class="mt-5 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Download APK</a>
            </div>

        </div>
    </div>
</x-app-layout>
