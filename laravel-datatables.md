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

# [fit] Examples

---

![inline autoplay](./assets/zero-config.mov)

^ This is what you get when you instantiate it on a table. In the example, the table has data (in `<tr>`s) already.

---

![inline autoplay](./assets/bells-whistles.mov)

^ So here we see column select (w/ one column not hidable and one not shown by default), multi-column sort, CSV export, not default visibility, sticky header

^ This is just a showcase for some of the cooler features you get. There are even more -- column groups, complex headers, reorderable columns, etc.

^ Codepen for this: https://codepen.io/nie7321/full/jjXGNL

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

![inline autoplay](./assets/nla-demo.mov)

^ Don't worry, it's all fake data (:hearts: faker)

^ This one is server-side in a Laravel app. You notice this is starting to not look like DataTables.net anymore. A lot of its stock UI elements have been stripped and replaced with buttons and the sidebar panels containing per-field search filters.

^ We used to have checkboxes too, which interacted w/ DataTables.net Buttons for server-side shenanigans.

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

# Setup DT.n JS libs in Laravel
- Install DT.n and desired addons via yarn
    - `yarn add datatables.net datatables.net-bs4 datatables.net-buttons datatables.net-buttons-bs4 datatables.net-dt`

- Add to app.js (via bootstrap.js) & app.css, compile
    - `yarn run dev` to run webpack

- I have a template w/ a basic initialization to see if we've installed it properly
    - I also set up a site layout w/ the mix'd assets
    - Table is copied from the DT.n basic initialization example
    - Magic is in the JS
        - A little bit of extra magic to enable colvis button + align properly for Bootstrap

^ We will start with a brand-new Laravel app skeleton. The DT.n packages are all up on the NPM package registry, so I'll yarn install them. 

^ I will be using the Bootstrap styling for DT.n, cuz Laravel already has Bootstrap in its `packages.json`. 

^ We're grabbing the DT.n Buttons extension, which has our column visbility & CSV/Excel/etc buttons.

^ Laravel Mix is the asset pipeline. It's webpack, except a smart person figured everything out and then gave us a Fisher-Price config file.

^ I've got the dependencies already installed. Take a look at the bootstrap.js & app.css files, then look at the first view!

---

# Setup `laravel-datatables`
- Install Laravel package
    - `composer require yajra/laravel-datatables`
    - `php artisan vendor:publish --tag=datatables && php artisan vendor:publish --tag=datatables-buttons`
    - Docs @ https://yajrabox.com/docs/laravel-datatables

- Put `buttons.server-side.js` into the Mix
    - `mv public/vendor/datatables/buttons.server-side.js resources/js/`
    - Update `app.js` & rebuild

^ The package we're installing comes with support for DT.n Buttons & DT.n Editor. Can install more specific packages if you want less. 

^ The second command will publish its configs to the `config/` directory. There are some settings here that control how searching works (case sensitivity, wildcards, etc). The defaults are fine for this demo, though!

^ The buttons publish will also drop a `buttons.server-side.js` file in your `public/js` dir. We'll just put that into the Mix pipeline.

---

# DataTables as a Service
- DT service class is how I prefer to use this
    - There are simpler ways for "basic" DTs, but all of mine have been complex

- Centralizes the ORM stuff, DT.n config, and any other DT-related code
    - Violates separation of the M & V parts of MVC a little bit, but is worth it
    - Stuff like DT.n `render` callback JS ends up in your PHP files 😨

- `php artisan datatables:make ServerSide`
    - Makes `App\DataTables\ServerSideDataTable`

- Lots of boilerplate
    - We care about `getColumns()`, `query()`, and `datatable()` (to start) 

^ As much as I find it gross to put JS snippets in PHP strings, I do feel like putting all this together makes it easier to manage big complex DataTables.

^ We'll wire this up to some models I have prepared.

---

# We need a DB
- We'll make an HR database.
    - `php artisan migrate:fresh --seed`

![inline](./assets/demo-db.png)

^ I have some stuff prepared to build and populate a DB, so we'll let that run. Real basic though!

---

# Wiring up the DT Service

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

# Testing
- Use Laravel Dusk
- Doing a bog-standard phpunit test for the controller(s) is painful

^ The table is very interactive and it does a lot of stuff on the client & server side. I really recommend a functional testing tool, like Laravel Dusk, for your tests here.

^ I do have a helper for doing controller tests, but it's not great.

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