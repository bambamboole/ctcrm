contactsModule = angular.module "ctcrm.sections.contacts", []

contactsModule.config ($stateProvider) ->
  $stateProvider.state "main.contacts",
    url: "kontakte/alle-kontakte"
    controller: "ContactsCtrl"
    templateUrl: "sections/contacts/contacts.tpl.html"
    resolve:
      contactGroups:(restApi) ->
        restApi.contactGroups.getAll().then (response) ->
          response.data
      contactTitles:(restApi) ->
        restApi.contactTitles.getAll().then (response) ->
          response.data
      contacts:(restApi) ->
        restApi.contacts.getAll().then (response) ->
          response.data
      numberTypes:(restApi) ->
        restApi.numberTypes.getAll().then (response) ->
          response.data

contactsModule.controller 'ContactsCtrl', ($scope, $http, $filter, contactGroups, contactTitles, contacts, numberTypes, restApi) ->

  emptyContact =
    id: -1,
    groupId: 1,
    tempName: "Neuer Kontakt",
    firstName: null,
    lastName: null,
    email: null,
    company: null,
    info: null,
    numbers:
      type: "Geschäftlich",
      number: null

  $scope.contactGroups = contactGroups
  $scope.contactTitles = contactTitles
  $scope.contacts = contacts
  $scope.numberTypes = numberTypes

  $scope.selectedGroupId = null
  $scope.setGroup = (groupId) ->
    $scope.selectedGroupId = groupId

  $scope.getGroupName = (id) ->
    $filter('getById')(contactGroups, id).name

  $scope.clearFilter = () ->
    $scope.selectedGroupId = null
    $scope.searchText = null

  $scope.selectContact = (contact) ->
    angular.forEach $scope.contacts, (contact) ->
      contact.selected = false
    $scope.selectedContact = contact

  $scope.newContact = () ->
    newContact = angular.copy(emptyContact)
    $scope.contacts.push newContact
    newContact.editing = true
    $scope.selectContact(newContact)

  $scope.cancelEdit = (contact) ->
    console.log contact
    if contact.id == -1
      $scope.contacts.pop()
      $scope.selectedContact = null
    else
      contact.editing = false

  $scope.deleteContact = (contactId) ->
    restApi.contacts.delete(contactId)
      .success () ->
        contactIndex = $filter('getIndexById')($scope.contacts, contactId)
        $scope.contacts.splice contactIndex, 1
        $scope.selectedContact = null

  $scope.setNumberType = (index, typeItem) ->
    console.log arguments

  $scope.getNumberType = (typeId) ->
    $filter('getById')($scope.numberTypes, typeId)


  $scope.deleteNumber = (numberIndex) ->
    $scope.selectedContact.numbers.splice numberIndex, 1

  $scope.addNumber = ->
    $scope.selectedContact.numbers.push
      type: null
      number: null

  $scope.editContact = ->
    $scope.selectedContact.editing = true

  $scope.saveContact = (contact) ->
    contact.editing = false
    restApi.contacts.save(contact)
    .success (response) ->
      console.log response
    .error (response) ->
      console.log response

  $scope.updateContactGroup = (contactGroup) ->
    restApi.contactGroups.save(contactGroup)
    .success (response) ->
      console.log response
    .error (response) ->
      console.log response

