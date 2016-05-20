'use strict'
angular.module('sbAdminApp')
  .controller('DashboardCtrl', function(UserService, IdeaService, $state) {

    var self = this;

    UserService.me().then(function(response) {
      self.me = response.data;
      getIdeas();
    });

    this.logout = function() {
      localStorage.removeItem('token');
      $state.go('login');
    };

    //this.ideas = [{title: "Title 1"},{title: "Title 1"},{title: "Title 1"}]

    function getIdeas() {
      IdeaService.getMemberIdeas(self.me.id).then(function(response) {
        self.myIdeas = response.data;
      });

      IdeaService.getOtherIdeas(self.me.id).then(function(response) {
        self.otherIdeas = response.data;
      });
    }

    this.addIdea = function(title, description) {
      var idea = {
        title: title,
        description: description,
        member_id: this.me.id
      };

      IdeaService.addIdea(idea).then(function(response) {
        if(response.status == 200) {
          self.myIdeas.push(response.data);
        } else {
          alert("Error on sending data");
        }
      });
    };

    this.deleteIdea = function(idea) {
      IdeaService.deleteIdea(idea._id).then(function(response) {
        getIdeas();
      });
    };

});
