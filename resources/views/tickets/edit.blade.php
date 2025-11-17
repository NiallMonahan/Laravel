<div>
    <x-app-layout>
        <div class="max-w-2xl mx-auto py-8">
            <h1 class="text-2xl font-bold mb-6">Edit Ticket</h1>

            <x-ticket-form :action="route('tickets.update', $ticket)" method="PUT" :ticket="$ticket" :event="$event" />
        </div>
    </x-app-layout>
</div>