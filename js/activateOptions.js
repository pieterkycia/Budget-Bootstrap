
		
//***************Edit user data***************//
			
let editNameButton = document.getElementById("editName");
let editNameInput = document.getElementById("newName");
			
let editEmailButton = document.getElementById("editEmail");
let editEmailInput = document.getElementById("newEmail");
			
let editPasswordButton = document.getElementById("editPassword");
let editPasswordInput = document.getElementById("newPassword");
			
editNameButton.addEventListener("click", function () 
{
	activateOptionUser(editNameButton, editNameInput);
});
			
editEmailButton.addEventListener("click", function () 
{
	activateOptionUser(editEmailButton, editEmailInput);
});
			
editPasswordButton.addEventListener("click", function () 
{
	activateOptionUser(editPasswordButton, editPasswordInput);
});
			
function activateOptionUser(button, input)
{
	editNameInput.setAttribute("disabled","");
	editEmailInput.setAttribute("disabled", "");
	editPasswordInput.setAttribute("disabled","");

	editNameButton.classList.add("deactiveButton");
	editEmailButton.classList.add("deactiveButton");
	editPasswordButton.classList.add("deactiveButton");
				
	button.classList.remove("deactiveButton");
	button.classList.add("activeButton");
				
	input.removeAttribute("disabled");
}
			
//***************Edit category data***************//
			
let addCategoryButton = document.getElementById("addCategory");
let addCategoryInput = document.getElementById("addCategoryName");
			
let deleteCategoryButton = document.getElementById("deleteCategory");
let deleteCategoryInput = document.getElementById("deleteCategoryName");
			
let editCategoryButton = document.getElementById("editCategory");
let editCategoryInput = document.getElementById("editCategoryName");
let editCategoryInputNew = document.getElementById("editCategoryNewName");
			
addCategoryButton.addEventListener("click", function () 
{
	activateOptionCategory(addCategoryButton, addCategoryInput);
});
			
deleteCategoryButton.addEventListener("click", function () 
{
	activateOptionCategory(deleteCategoryButton, deleteCategoryInput);
});
			
editCategoryButton.addEventListener("click", function () 
{
	activateOptionCategory(editCategoryButton, editCategoryInput); 
	editCategoryInputNew.removeAttribute("disabled");
});
			
function activateOptionCategory(button, input)
{
	addCategoryInput.setAttribute("disabled", "");
	deleteCategoryInput.setAttribute("disabled","");
	editCategoryInput.setAttribute("disabled","");
	editCategoryInputNew.setAttribute("disabled","");

	addCategoryButton.classList.add("deactiveButton");
	deleteCategoryButton.classList.add("deactiveButton");
	editCategoryButton.classList.add("deactiveButton");
				
	button.classList.remove("deactiveButton");
	button.classList.add("activeButton");
				
	input.removeAttribute("disabled");
}
