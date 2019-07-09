# [fit] Cool table UX 
## with DataTables.net 
## &
## Laravel

---

# DataTables.net
- Open source JS library for Fancy Tables
    - Needs jQuery
    - Plays nice w/ Bootstrap, Semantic, jQuery UI

- Pretty nice out of the box !

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

