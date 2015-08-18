articlesModule = angular.module "ctcrm.sections.articles", []

articlesModule.config ($stateProvider) ->
  $stateProvider.state "main.articles",
    url: "angebote/artikel"
    controller: "ArticlesCtrl"
    templateUrl: "sections/offers/articles/articles.tpl.html"
    resolve:
      articleGroups: (restApi) ->
        restApi.articleGroups.getAll().then (response) ->
          response.data
      articles: ($http, restApi) ->
        restApi.articles.getAll().then (response) ->
          response.data

articlesModule.controller 'ArticlesCtrl', ($scope, $http, $filter, ngTableParams, $modal, articleGroups, articles, restApi) ->

  articleGroups.unshift
    id:-1
    name: 'neue Artikelgruppe'

  $scope.articleGroups = articleGroups
  $scope.articles  = articles

  params =
    page: 1
    count: 10

  $scope.tableParams = new ngTableParams params,
    total: $scope.articles.length
    getData: ($defer, params) ->
      $defer.resolve $scope.articles.slice((params.page() - 1) * params.count(), params.page() * params.count())

  $scope.selectedGroup = ''

  $scope.setGroup = (group) ->
    $scope.selectedGroup = group

  $scope.clearFilter = ->
    $scope.selectedGroup = ''
    $scope.searchText = ''

  $scope.updateArticleGroup = (articleGroup) ->
    restApi.articleGroups.save(articleGroup)
      .success (response) ->
        console.log response
      .error (response) ->
        console.log response

  $scope.updateArticle = (article) ->
    restApi.articles.save(article)
      .success (response) ->
        console.log response
        $scope.article.$edit = false
      .error (errorMsg) ->
        console.log errorMsg

  modalInstance = null
  $scope.openModal = ->
    console.log 'modalopen'
    modalInstance = $modal.open
      templateUrl: 'sections/offers/articles/newArticleModal.tpl.html'
      controller: 'NewArticleModalCtrl'
      scope: $scope

    modalInstance.result.then (newArticle) ->
      restApi.articles.save(newArticle)
        .success (articleId) ->
          console.log articleId
          newArticle.id = articleId
          $scope.articles.push newArticle
        .error (errorMsg) ->
          console.log errorMsg


articlesModule.controller 'NewArticleModalCtrl', ($scope, $modalInstance) ->
  $scope.newArticle = {
    id: -1
    groupId: null
    newGroup: null
    name: null
    purchaseInfo: null
    price: null
    visible: true
  }

  $scope.save = ->
    console.log 'save'
    $modalInstance.close $scope.newArticle

  $scope.cancel = ->
    console.log 'cancel'
    $modalInstance.dismiss 'cancel'