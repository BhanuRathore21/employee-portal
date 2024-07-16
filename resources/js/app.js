/*
  Add custom scripts here
*/
import { library, dom } from '@fortawesome/fontawesome-svg-core';
import { fas } from '@fortawesome/free-solid-svg-icons';
import { far } from '@fortawesome/free-regular-svg-icons';
import { fab } from '@fortawesome/free-brands-svg-icons';

// Add icons to the library
library.add(fas, far, fab);

// Initialize FontAwesome library
dom.watch();