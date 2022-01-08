###################
CHANGELOG - Gil Alvarez Developer Branch
###################

**All current code changes are temporarily moved on dev_branch_cobilla**

**Visit the live site! https://mealsformakers.xyz/**


*******************
v1.0.1b code change, codename: "Minimalisticx" (week 5)
*******************

* Added edit function for own recipes
* Fixed messaging page (can only read messages at the moment)
* fixed some bugged CRUD functions
* fixed registration user data validation

* BUGS:
	* Messaging functions are not complete
	* No edit function for account profile yet
	* Getings controller would sometimes return 500 error code


*******************
v1.0.1a code change, codename: "Gil Puyat" (week 3)
*******************

* Connection of backend CRUD functions to frontend
	* jQuery realtime update of data
* Fix for getSuggestedRecipes() function
	* break only 2 loops
* add additional CRUD functions
	* getAllIngredientsLiterally()
	* getDashboardCounts()
	* getRandomRecipe()
	* getAllRecipes_summary_currentUser()
	* getAllCategories()
* added category table and category column to recipes

* BUGS:
	* Messaging not working yet
	* No edit functions yet
	* Getings controller would sometimes return 500 error code


*******************
v1 code change, codename: "Shopee 11.11" (week 1, task 4)
*******************
* Rewritten index htaccess to allow for direct controller access
* Creation of Theoretical CRUD Functions according to ER Model:
	* SHA-512 Salting Function
	* Random String Generator (for indexing)
	* Input date to MySQL Date Format conversion
	* Functions for user data CRUD
	* Functions for recipe CRUD
	* Functions for ingredients CRUD
	* Functions for comments CRUD
	* Functions for upvotes CRUD
	* Function for messages CRUD
	* Functions for recipe suggestion (subject to optimizatio)
* Database Model Changes
