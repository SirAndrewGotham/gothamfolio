## TODOs

Some TODOs to consider in the future.

Placed here not to disturb the code with unsolved TODOs upon submitting to the repo.

- SoftDeleted Works (and others to that matter) not considered anywhere, please consider. This is important as if in works, for example, we delete one of the translations, that particular translation language will become available in the translation languages list once again. But it won't be successfully saved to the database displaying unique verification error on submit, as corresponding translation is already available in the SoftDeleted set. The right way to do that would probably be displaying soft deleted item with corresponding message and in option to undelete and save edited version.
- User priority (default) language for the items in different languages. Now items in all of the user-enabled languages will be displayed. Which is not an issue for now, as we do not allow user registration, thus they have no opportunity to choose a set of preferred languages. This is only available to the admin user (for now). But make it really functional, we should group items by parent ids and display the ones in the user default language (or system default if user does not have one, or there is no translation to the user default language, in which case translation should be picked up from user-enable preferred set of languages rather that system default, as system default language might be out of the scope of user defined preferred languages) with a notice (button) about content available in other languages, the button will give an option to go tho the item version in other langauges.
- 
