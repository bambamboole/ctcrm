navigationModule = angular.module "ctcrm.navigation", []

navigationModule.directive 'ctcrmNavigation', ->
  restrict: 'E'
  templateUrl: 'navigation/navigation.tpl.html'
  controller: 'NavigationCtrl as navigation'


navigationModule.controller 'NavigationCtrl', ($state) ->
  @menu = [
    {
      name: "Dashboard"
      state: "main.dashboard"
      active: true
      access: "user"
    }
    {
      name: "anrufverwaltung"
      active: false
      access: "user"
      sub: [
        {
          name: "Anrufe"
          state: "main.calls"
          active: false
          access: "user"
        }
        {
          name: "Archiv"
          state: "main.callsArchive"
          active: false
          access: "user"
        }
#        {
#          name: "Statistik"
#          state: "main.callsStatistics"
#          active: false
#          access: "user"
#        }
#        {
#          name: "SMS"
#          state: "main.sms"
#          active: false
#          access: "user"
#        }
      ]
    }
    {
      name: "aufgaben"
      state: "main.tasks"
      active: false
      access: "user"
    }
    {
      name: "kontakte"
      state: "main.contacts"
      active: false
      access: "user"
    }
#    {
#      name: "angebote"
#      access: "user"
#      sub: [
#        {
#          name: "Neues Angebot"
#          state: "main.newOffer"
#          active: false
#          access: "user"
#        }
#        {
#          name: "Aktuelle Angebote"
#          state: "main.currentOffers"
#          active: false
#          access: "user"
#        }
#        {
#          name: "Angebotsarchiv"
#          state: "main.offersArchive"
#          active: false
#          access: "user"
#        }
#        {
#          name: "Artikel"
#          state: "main.articles"
#          active: false
#          access: "user"
#        }
#      ]
#    }
#    {
#      name: "Aufträge"
#      access: "user"
#      sub: [
#        {
#          name: "Aktuelle Aufträge"
#          state: "main.currentOrders"
#          active: false
#          access: "user"
#        }
#        {
#          name: "Archiv"
#          state: "main.ordersArchive"
#          active: false
#          access: "user"
#        }
#      ]
#    }
    {
      name: "Toner"
      access: "user"
      sub: [
        {
          name: "Suche"
          state: "main.searchToners"
          active: false
          access: "user"
        }
        {
          name: "Bestellung"
          state: "main.orderToners"
          active: false
          access: "user"
        }
      ]
    }
    {
      name: "Verwaltung"
      access: "admin"
      sub: [
        {
          name: "Benutzer"
          state: "main.users"
          active: false
          access: "admin"
        }
      ]
    }
  ]

  @goto = (item) ->
    console.log item, $state.get toState
    return unless item.state
    toState = item.state
    if $state.get toState
      $state.go toState
    else
      console.log 'State not found', toState
  @