# Formbuilder
Drag-and-Drop Form Builder using the [JQuery Form Builder](https://formbuilder.online).

<img src="https://i.imgur.com/4zT4CY9.jpg" width="400">

<img src="https://i.imgur.com/oEkjSCS.jpg" width="400">

The forms fields are saved as json and stored in your database. A member of your site can create, edit and delete forms. Forms belong to the users that created them and each form has a unique link that can be shared publicly.

The json version of the form can be used to render the form for users to fill.

Example Json Form:
```json
[{"type":"header","subtype":"h1","label":"Demo Form 01"},{"type":"paragraph","subtype":"p","label":"This demo form is a potluck sign-up sheet"},{"type":"text","label":"Name","className":"form-control","name":"name","subtype":"text"},{"type":"radio-group","label":"Food Category","name":"foodcategory","other":true,"values":[{"label":"Appetizer","value":"Appetizer"},{"label":"Beverage","value":"Beverage"},{"label":"Salad","value":"Salad"},{"label":"Main","value":"Main"},{"label":"Dessert","value":"Dessert"}]},{"type":"number","label":"How many will it serve","className":"form-control","name":"numberserved","min":"1","max":"50","step":"1"},{"type":"text","label":"Dish Name","className":"form-control","name":"dishname","subtype":"text"},{"type":"checkbox-group","label":"Dietary Restrictions","description":"Which of the following does your dish contain?","name":"dietaryrestrictions","values":[{"label":"Alcohol","value":"Alcohol"},{"label":"Carbs","value":"Carbs"},{"label":"Dairy","value":"Dairy"},{"label":"Egg","value":"Egg"},{"label":"Fish","value":"Fish"},{"label":"Gluten","value":"Gluten"}]},{"type":"textarea","label":"Comment","className":"form-control","name":"comment","subtype":"textarea"}]
```

Form permission options
+ Public - anyone can submit the form without needing to login
+ Private - only authenticated members of your site can access the form. Provide the option for users to edit their previous submissions.

Installation

```bash
composer install
php artisan migrate
```
```bash
adding the following line to your .env file MAIL_MAILER=log
```

Fibonacci Agile Estimation: 34

