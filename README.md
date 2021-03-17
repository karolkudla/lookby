# Lookby - Semi - Autonomous Affiliative Marketing Multishop MVP
It is on top of Wordpress but can easily be transformed to standalone.

System downloads products with images, descriptions, attributes and urls, from choosed vendors, and adds them to the shop.
It uses .CSV product files and vendor API's.

Because every vendor has their own category schema - products categories are mapped on-the-fly after download, from vendors categories to system categories, based on special dictionary .csv files.
System administrator can see AJAX live table with mapped names/categories during mapping.
If it is impossible to determine the vendor category because it is null, system can determine the category from product name. 
Menu is also generated automatically from products categories.

System is super fast because it uses his own MYSQL tables to store products data.

We can see that system match every product category ideally, what we can see on left table.
Right table is empty - it is populated only if category isn't found.
Then we can update our .CSV's mapper files.

Admin has the ability to download products by category or by vendor, and can choose if to populate the database on-the-fly or not.
![konsola](https://user-images.githubusercontent.com/35747845/111485646-162e0d80-8737-11eb-9af8-d8c6fd584957.png)

There is a turned-off function of availability checking for every product,
because one important file is missing, but I can back engineer it if I got time.

demo https://lookby.wokulski.online

