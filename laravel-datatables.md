# [fit] Cool table UX 
## with DataTables.net & Laravel
#### Presented by Nick Evans, Senior Dev @ Northwestern IT

---

# DataTables.net
- Open source JS library for Fancy Tables
    - Needs jQuery
    - Plays nice w/ Bootstrap, Semantic, jQuery UI

- Pretty nice out of the box
    - The docs have a showcase w/ all the different features (& example code)

- Use it as the core of an app's UX: the main page that lists all the stuff people interact with

^ This talk isn't *just* about Laravel. There's stuff here for you if you just want ideas on using DT.n.

---

# TODO: showcase slide 1
- what you get out of the box

---

# TODO: showcase slide 2
- all the bells and whistles
    - column select
    - exports
    - sticky header
    - reorganized UI elements
    - multi-column ordering
    - expandable

^ This is just a showcase for some of the cooler features you get. You *probably* don't want to combine all of this, but for demo purposes...

---

# TODO: showcase slide 3
- radically different DT.n look (NLA)

^ Don't worry, it's all fake data (:hearts: faker)

^ But this is starting to not look like DataTables.net anymore. A lot of its stock UI elements have been stripped and replaced with buttons and the sidebar panels containing per-field search filters.

^ We used to have checkboxes too, which interacted w/ DataTables.net Buttons for server-side shenanigans.

---

# AJAX
- DT.n has full support for making everything server-side
    - Pagination & sorting
    - Search across all columns
    - Search specific columns
    - Exports

^ Sometimes with small tables, you can get away with just dumping your whole dataset into the page as JSON and doing client-side manipulations. But that doesn't scale.

^ So it has a whole thing for communicating with the server. It can get kind of complicated when you add more and more features, like multi-column sorting and a bunch of filters.

---

# Laravel
- Popular PHP framework
- Eloquent ORM
- `yajra/laravel-datatables` translates all the inputs from DT.n into the expected outputs
    - And it uses your models to do it

^ I'm Northwestern's foremost member of the Laravel cult, so I obviously am going to talk about it !

^ Pushing all the hard processing off the client and onto the server is great.

---

# [fit] Walkthrough !

^ OK so now we're going to go through setting everything up and writing some code.

^ Haven't risked live-coding before a studio audience before. Wish me luck.

---

# Setup
- New Laravel app
- Install DT.n and desired addons via yarn
    - Add to app.js & app.css, compile (via mix)
- Install Laravel package via composer
    - `php artisan something` to make the service class

^ Laravel Mix is the asset pipeline. It's webpack except a smart person figured everything out and then gave us a Fisher-Price config file.

^ We'll talk about the DataTable service class more soon. It's my preferred way of implementing this, but there are several less-complex approaches where you just add a couple lines of code to your controller and Magic happens.

---

# Building Out the Service
- Service class can be used in a controller
- Centralizes the ORM stuff, DT.n config, and any other DT-related code
- Violates separation of the M & V parts of MVC a little bit, but is worth it
    - Stuff like DT.n `render` callback JS ends up in your PHP files 😨

^ As much as I find it gross to put JS snippets in PHP strings, I do feel like putting all this together makes it easier to manage big complex DataTables.

---

# Alternative: Set up a query and return it
- This is a good way to approach simpler stuff
- DataTable config JS stays in the views where it belongs

---

# Make the UX better
- Let's redesign our table a bit
    - Get rid of some elements w/ `dom`
- Add our own filter controls & wire them up
- Make the pages bigger
- Turn on sticky headers

---

# Scoping to Our User
- Scopes are a way of injecting data from your controller into the DT.n service class
    - IMO `Auth` facade is kinda gross

---

# Export to CSV
- DT.n has CSV/Excel/PDF exports out of the box
    - But it's a client-side export, so it only exports 1 page of AJAX'd data

- `yajra/laravel-datatables` redefines the export button definitions for server-side exports!

^ One caveat: if you're bolting this in to an existing app w/ DT.n, **this JS redefines the export button definitions**. If you have any non-yajra DTs, their exports will break!

---

# [fit] DT.n Editor
^ TODO: bg of editor

^ I should mention DataTables.net Editor. It's a paid first-party addon that lets you add/update/delete rows in tables. It's got a whole AJAX protocol for submitting & dealing with validation errors. Licensing is per-dev (across all the apps you want) @ US$120 per head (one time). 

^ The Laravel datatables package supports doing server-side stuff for it, but I have yet to try it out.

---

# Learning More
- DataTables.net docs have lots of examples
- https://yajrabox.com/docs/laravel-datatables

- Talk & source code are available on GitHub
    - https://todo

^ The QR code goes to the github repo. iPhone users, just hold your camera up & it'll recognize it.

^ Not sure how Android does QR codes, sorry!

---

# Credits
- **McCormick IT**, whose work I am iterating on
- **ADO-SysDev**, who have been working w/ these tools for the last few months

---

# [fit] Thanks for listening!