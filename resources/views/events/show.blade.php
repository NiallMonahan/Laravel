<div>
    <x-app-layout>
        <div class="py-8">
            <x-event-details :title="$event->title" :description="$event->description" :image="$event->image"
                :event_date="$event->event_date" :location="$event->location" :capacity="$event->capacity" />
        </div>
    </x-app-layout>

</div>