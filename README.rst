=======
Kagency
=======

Kagency is supposed to support you with information you need in the current
context and means to automatically or semi-automatically act based on
information.

Usage
=====

To be defined. Currently this is just an experiment.

Milestones
==========

* [ ] Register for RSS event source and replicate new entries to client

* [ ] Learn about important feed entries based on user rating

* [ ] Display certain feeds based on context: Working / Free time

* [ ] Highlight critical transactions from account

* [ ] Show contacts based on current appointment

* [ ] Create new appointments

* [ ] Automatically follow and unfollow conference hash tag on twitter while
  attending a conference.

Architecture
============

All event sources and synchronization with data providers can be (and should)
processed by a server. The events can be versioned, thus an offline-first
client could receive new events. Responses by the client (also events?) could
be versioned as well and be replicated back to the server once the client is
online again.

Kagency could primarily as a webservice in this picture.

The context of a client largely depends on a current state (time, weather,
current appointments) and thus can't be cached and requires online processing.
Since the context might require additional data from data providers, it might
only be possible to provide full event filtering when online.

If the entire computational element (data) is tranferred to the client and only
updated by the server side, we could apply the filters based on the local data
on the offline device. In such a case we will probably have client and server
side filters. Server side filters will probably annotate "static" information
like preferences learned by certain algorithms.

Concepts
========

This sections describes the concepts behind Kagency and how they interact with
each other.

ContextProvider
---------------

Enriches the current user context with additional information. Examples:

* Time

* Current appointment

* Location

* Important events

* Currently executed task

* Current weather

EventSource
-----------

Source of events happening somewhere. Examples:

* Twitter

* RSS feeds

* Calendar events

* Account transactions

* Emails

* New search results

Filter
------

Filters can increase or reduce the priority of an event based on the current
context and (maybe) the content of the event. Examples:

* Learn which news / tweets are irrelevant (Bayes?)

* Display company contacts while on an appointment

* Highlight private TODOs outside working hours, when due

Agent
-----

Agents are actors, which perform certain actions based on an event. Agents
might require user interaction or feedback. Examples:

* Adding a TODO entry

  * Resolving it again

* Answering an email

* Performing an account transaction

* Installing a new event source

  * Twitter search for an event hashtag based on a current calendar entry

DataProvider
------------

A data provider is meant to provide (cached) access to data sets, which can be
used by the component sin the system. This could for example be a list of
twitter followers or facebook friends.


..
   Local Variables:
   mode: rst
   fill-column: 79
   End: 
   vim: et syn=rst tw=79
