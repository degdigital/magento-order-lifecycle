Thing Happens in Module1 -> Dispatches Event
Observer in Module1 listens and catches dispatch
Observer in Module1 would create a data array with data it wants to save and dispatches "save_lifecycle_event" with data array
Observer in OrderLifecycle listens and creates "Lifecycle/Event" and saves to registry