<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id(); // primary key

            $table->string('title');              // event name/title
            $table->text('description')->nullable(); // event details (optional)
            $table->date('event_date');           // date of the event
            $table->string('location');           // where the event is held
            $table->decimal('latitude', 10, 7)->nullable();  // GPS latitude for map
            $table->decimal('longitude', 10, 7)->nullable(); // GPS longitude for map
            $table->integer('capacity')->nullable(); // max attendees (optional)
            $table->string('image')->nullable();  // path/filename for event image

            $table->timestamps(); // created_at & updated_at
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
