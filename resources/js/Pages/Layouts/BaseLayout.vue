<template>
    <div>
      <header>
        <!-- Common header content -->
        <nav>
          <!-- Common navigation links -->
        </nav>
      </header>
      <main>
        <slot></slot>
      </main>
      <footer>
        <!-- Common footer content -->
      </footer>
    </div>
  </template>
  
  <script>
  export default {
    name: 'BaseLayout',
  };
  </script>
  