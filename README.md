# Boxpacker

Pack delivery items into boxes that you define for couriers.

### Installation
Upload to extensions in the following folder format:

`extensions/thoughtco/boxpacker/`

In the admin user interface enable the extension.


### Boxes

After installation a new link will appear under "Restaurant" to allow you to define box sizes and assign them to locations.

### Menus

New fields will be added to menus with dimensions (width, height, depth and weight) that are required to make this extension function properly.

### New orders

New delivery orders will have a "boxes" field in the database with the packing requirements for the items in the cart. Retrieve this information and pass it onto your courier through an API call.