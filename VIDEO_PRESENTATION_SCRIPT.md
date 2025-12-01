# CA2 Video Presentation Script - Event Management Application

**Student:** [Your Name]  
**Module:** Advanced Web Development  
**Lecturer:** Anne Wright  
**Duration:** Approximately 10-12 minutes

---

## INTRODUCTION (1 minute)

**[Screen: Show your application homepage]**

"Hello, my name is [Your Name], and today I'll be presenting my CA2 project for Advanced Web Development. I've built a comprehensive Event Management Application using the Laravel framework.

This application allows users to browse and search for events, view event details on an interactive map, and discover artists performing at various events. Administrators have additional privileges to create, edit, and manage both events and artists through a role-based access control system.

The project demonstrates my understanding of Laravel's MVC architecture, Eloquent relationships, CRUD operations, authentication, and authorization."

---

## 1. DATABASE DESIGN & RELATIONSHIPS (2-3 minutes)

**[Screen: Show ERD or database structure - you can open a migration file]**

### One-to-Many Relationships

"Let me start by explaining the database architecture. My application has three main resources: Events, Artists, and Tickets, plus a Users table for authentication.

**[Open Event Model]**

First, I have a one-to-many relationship between Events and Tickets. Each event can have multiple tickets, but each ticket belongs to only one event.

In my Event model, I've defined this relationship using the `hasMany` method:

```php
public function tickets()
{
    return $this->hasMany(Ticket::class);
}
```

**[Open Ticket Model]**

And in the Ticket model, the inverse relationship uses `belongsTo`:

```php
public function event()
{
    return $this->belongsTo(Event::class);
}
```

This creates a foreign key `event_id` in the tickets table, which you can see in my migration files."

### Many-to-Many Relationship

**[Open Event and Artist Models]**

"The more complex relationship is the many-to-many between Events and Artists. An event can feature multiple artists, and an artist can perform at multiple events.

In Laravel, this requires a pivot table called `artist_event` that stores the relationships between the two tables.

In the Event model:

```php
public function artists()
{
    return $this->belongsToMany(Artist::class);
}
```

And the same in the Artist model:

```php
public function events()
{
    return $this->belongsToMany(Event::class);
}
```

This pivot table approach is essential for many-to-many relationships and follows Laravel's naming convention."

---

## 2. ROLE-BASED ACCESS CONTROL (1-2 minutes)

**[Screen: Show User model and registration form]**

"My application implements two user roles: 'user' and 'admin'. This is stored in the users table with a role column.

**[Open RegisteredUserController or show registration form]**

When users register, they can select their role. I added validation to ensure only 'user' or 'admin' are accepted:

```php
'role' => ['required', 'in:user,admin'],
```

**[Open EventController create method]**

Regular users can browse events, view details, and see the map. However, only admins can create, edit, or delete events and artists. I enforce this in my controllers using middleware and role checks:

```php
if (auth()->user()->role !== 'admin') {
    return redirect()
        ->route('events.index')
        ->with('error', 'Access denied.');
}
```

This ensures that even if someone tries to access the create route directly, they'll be denied unless they're an admin."

---

## 3. CRUD FUNCTIONALITY - EVENTS (3-4 minutes)

**[Screen: Navigate to Events Index page]**

### CREATE

"Let me demonstrate the full CRUD functionality for events.

**[Click 'Create New Event' - only visible if admin]**

As an admin, I can create a new event. The create form includes:

-   Title and description fields
-   Event date picker
-   Location with latitude and longitude for map display
-   Image upload
-   Multi-select for artists

**[Open EventController store method]**

When the form is submitted, the store method validates all inputs:

```php
$validated = $request->validate([
    'title' => 'required|string|max:255',
    'description' => 'required|string',
    'event_date' => 'required|date',
    'location' => 'required|string|max:255',
    'latitude' => 'nullable|numeric|between:-90,90',
    'longitude' => 'nullable|numeric|between:-180,180',
    'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
    'artists' => 'array',
]);
```

The image is handled separately - it's moved to the public/images/events directory with a unique timestamp name. Then I create the event and attach the selected artists using the `attach` method on the many-to-many relationship."

### READ

**[Navigate back to Events Index]**

"The Read functionality has two parts. The index page displays all events in a card layout.

**[Show search bar]**

I've implemented a search feature that filters events by title or description:

```php
if ($search) {
    $events = Event::where('title', 'like', "%{$search}%")
        ->orWhere('description', 'like', "%{$search}%")
        ->get();
}
```

**[Click on an event to show details]**

Clicking on an event shows the detail page, where I eager load the relationships to avoid N+1 query problems:

```php
$event->load('tickets', 'artists');
```

This displays the event information, associated artists with their genres, and all tickets for that event."

### UPDATE

**[Click Edit button - only visible if admin]**

"Admins can edit existing events. The edit form is pre-populated with current data.

**[Open EventController update method]**

The update method validates the input similarly to create, but uses the `update` method on the existing model. For the many-to-many artists relationship, I use `sync` instead of `attach`:

```php
$event->artists()->sync($request->artists);
```

This updates the pivot table, removing old associations and adding new ones."

### DELETE

**[Point to Delete button]**

"Finally, the destroy method deletes the event. I've added logic to also delete the uploaded image file if it exists:

```php
if ($event->image && file_exists(public_path($event->image))) {
    unlink(public_path($event->image));
}
$event->delete();
```

This prevents orphaned files from cluttering the server."

---

## 4. CRUD FUNCTIONALITY - ARTISTS (2 minutes)

**[Screen: Navigate to Artists page]**

"The Artists resource follows a similar CRUD pattern.

**[Show Artists Index]**

Users can view all artists with their genres and bios.

**[Click Create New Artist - if admin]**

Admins can create artists with a name, genre, bio, and profile image. The image is saved with a standardized naming convention based on the artist's name.

**[Open ArtistController store method]**

```php
$imageName = strtolower(preg_replace('/[ !-]/', '_', $artist->name)) . '.jpg';
```

This ensures consistent naming - for example, 'Taylor Swift' becomes 'taylor_swift.jpg'.

**[Click on an artist]**

The artist detail page shows their information and lists all events they're performing at, demonstrating the inverse of the many-to-many relationship."

---

## 5. ADDITIONAL FEATURES (1-2 minutes)

### Events Map

**[Navigate to Events Map]**

"One advanced feature I implemented is an interactive map using Leaflet.js. Events with latitude and longitude coordinates are displayed as markers on the map.

**[Show map markers]**

Clicking a marker shows a popup with the event details and a link to the full event page. This provides a visual way to discover events based on location.

**[Open EventController map method]**

The controller filters events to only include those with coordinates:

```php
$events = Event::whereNotNull('latitude')
    ->whereNotNull('longitude')
    ->with('artists')
    ->get();
```

The `with('artists')` eager loads the artists to display in the popup."

### Authentication System

**[Show login/register pages]**

"I've customized Laravel's authentication scaffolding with a dark theme to match my application's design. The guest layout uses a dark background with light text for better visual consistency."

---

## 6. MVC ARCHITECTURE EXPLANATION (1 minute)

**[Screen: Show file structure]**

"My application follows Laravel's MVC pattern:

**Models** - Located in `app/Models`, these define the database structure and relationships. They represent the data layer.

**Views** - Located in `resources/views`, these are Blade templates that display data to users. I've organized them by resource: events, artists, tickets.

**Controllers** - Located in `app/Http/Controllers`, these handle the application logic. The EventController and ArtistController process requests, interact with models, and return views.

**Routes** - Defined in `routes/web.php`, these map URLs to controller methods and apply middleware for authentication and authorization.

This separation of concerns makes the code maintainable, testable, and follows Laravel best practices."

---

## 7. CODE QUALITY & COMMENTS (30 seconds)

**[Show commented code sections]**

"Throughout my codebase, I've included comprehensive comments explaining the purpose and functionality of each method. For example:

```php
// Deal with the uploaded picture if the user sent one
// Grab whatever the user typed in the search bar
// Only delete the image if it's a real uploaded file
```

These comments demonstrate my understanding of the code and make it easier for others to maintain."

---

## CONCLUSION (30 seconds)

**[Screen: Show homepage or final demo]**

"To summarize, my Event Management Application demonstrates:

-   Three resources with proper CRUD functionality
-   A one-to-many relationship between Events and Tickets
-   A many-to-many relationship between Events and Artists with a pivot table
-   Role-based access control with user and admin roles
-   Advanced features including search functionality and an interactive map
-   Proper MVC architecture following Laravel conventions
-   Clean, well-commented code committed to GitHub

Thank you for watching my presentation. I'm happy to answer any questions about my implementation."

---

## DEMO SCHEDULE TO FOLLOW (In Order)

1. ✅ Homepage overview
2. ✅ Show database relationships (models)
3. ✅ Register/Login (show role selection)
4. ✅ Events Index (show all events)
5. ✅ Search events
6. ✅ View single event (show tickets and artists)
7. ✅ Create new event (admin only)
8. ✅ Edit event (admin only)
9. ✅ Delete event (admin only)
10. ✅ Artists Index
11. ✅ View single artist (show their events)
12. ✅ Create new artist (admin only)
13. ✅ Events Map with markers
14. ✅ Show code comments in controllers
15. ✅ Show MVC file structure

---

## TIPS FOR RECORDING

-   **Speak clearly and at a moderate pace**
-   **Use screen recording software** (OBS Studio, Loom, or Windows Game Bar)
-   **Show your face** in a small webcam window (professional but friendly)
-   **Practice the demo flow** beforehand to avoid mistakes
-   **Have your GitHub repository** open in another tab to show at the end
-   **Keep it under 15 minutes** as per requirements
-   **Test your audio and video quality** before final recording
-   **Don't rush** - take pauses between sections

---

## WHAT TO SHOW IN YOUR GITHUB

At the end of the video, briefly show:

-   Your GitHub repository with all commits
-   Commit messages showing development progress
-   README.md if you have one
-   File structure

---

## KEY POINTS TO EMPHASIZE

✅ **Three resources**: Events, Artists, Tickets  
✅ **One-to-Many**: Event → Tickets  
✅ **Many-to-Many**: Events ↔ Artists (with pivot table)  
✅ **Two user roles**: User and Admin  
✅ **Role-based functionality**: Different access levels  
✅ **Full CRUD**: Create, Read, Update, Delete for all resources  
✅ **Laravel MVC**: Proper architecture and conventions  
✅ **Code comments**: Well-documented throughout  
✅ **Additional features**: Search, Map, Image uploads

Good luck with your presentation! 🎓
