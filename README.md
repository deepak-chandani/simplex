## Simplex - create your own framework on top of Symfony components

 - get familiar with the symfony's reusable components & then integrate those to build our project and developing our own framework.

### Components used
 - **`HttpFoundation`** component - replace the default PHP global variables and functions by an Object-Oriented layer.
 - **`Routing`** component
 - **`HttpKernel`** & **`ControllerResolver`**
 - **`EventDispatcher`** - to dispatch events in between the request-response lifecycle
 - **Dependency-Injection**

 ---

### Introduction
**Symfony is a reusable set of standalone, decoupled and cohesive PHP components that solve common web development problems.**
You can pick the ones you need for the specific web application you are going to develop.
 - Will your application require object oriented handling of http-request-response ? just install the `HttpFoundation` component
 - Will your application require routing of request to different controllers ? just install `Routing` Component.
 - If your app requires dispatching of events so that listeners can do their work ? just install `EventDispatcher` component.


  You can build a full-fledged , interactive web application by integrating together all the components.
  Using Symfony you **won't have to "reinvent the wheel" for each project**. 

### Author
Deepak Chandani
[Deepak Chandani](https://www.linkedin.com/in/deepak-chandani-66676727/)
