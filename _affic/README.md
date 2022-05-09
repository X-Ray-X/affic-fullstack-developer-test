# Affic Full-Stack Developer Test

_If you came across this repository and are curious to know more, visit the [Affic Careers](https://affic.com/careers) page for more information!_

## Foreword
This test is to observe your problem-solving and approach to a project scope.

We understand that take-home tests take personal time, therefore we do not exclusively look at **how** you code, rather _how_ you approach, solve, and finally implement your solutions.

## Scope
Affic is building the infrastructure for the future of work. To allow this to happen, we must connect to property management systems and expose their data to potential sellers.

Given this, we must transform data from arbitrary APIs and normalise it into a common API format. This result should then be stored in a database.

Attached are two example API responses:
* PMS 1: `data/pms-response-1.json` 
* PMS 2: `data/pms-response-2.json`

There is a lot of crossover between different systems, but their interpretation of room data may vary. It is up to you to think how this should be resolved, so that consumers can connect to our API and get a normalised result.

For this test, there are five properties to consider:
* Name of room
* Capacity
* Photo
* Amenities
* Rate(s)

## Requirements
* Backend that consumes the example API responses
  * Hint: keep in mind what happens if a room changes in subsequent updates
* Normalisation interface that consumes the two response schemas
  * Hint: think about how the interface could be extended for any PMS response
* API that allow retrieval of a single room or rooms
* Basic frontend that allows
  * Viewing all rooms
  * Viewing a single room

Affic utilises the following technologies. You are free to use your own discretion, but keep this in mind when developing your solution:
* PHP 8.1 + Laravel 9
* PostgreSQL 9.4+
* Docker

For the front-end we have no concrete decision, therefore feel free to use what feels comfortable!

## What we would like to see
* Your code (obviously!), with comments
* Git commit history (if you send it to us as a zip, include the `.git` folder)
* Instructions on how to run your code
* Notes and observations
* Tests a plus!

## Time limit
We expect the above to take approximately 6 hours, but we do not consider time of development as part of the evaluation.