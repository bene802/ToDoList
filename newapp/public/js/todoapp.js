var app = angular.module('todoapp', []);

app.controller('appCtrl', function($scope, $http) {
    // const baseUrl = "http://127.0.0.1:8000/";
    const baseUrl = "http://localhost:8888/newapp/public/";

    $scope.name = "John";
    $scope.statuses = ["complete", "pending"];
    $scope.status = "pending";
    /**
     * TODO:
     * 1.use $http to call backend rest API
     * GET todos(Which is corresponding to index() function inside TodoController)(AJAX CALL)
     * 2.store all data in todolist variable, then use ng-repeat to show a list(using ul li tag) in index.html
     */
    retrieveList();

    function request(method, url, params, callback) {
        $http({
            method: method,
            url: url,
            params: params
        }).then(response  => {
            callback(null, response);
        }, err => {
            callback(err);
        });
    }

    function retrieveList() {
        request("GET", baseUrl+"todos", {}, (err, result) => {
            if (err) {
                console.log(err);
            } else {
                $scope.todoList = result.data;
                console.log(result.data)
            }
        })
    }
    /**
     * TODO:
     * 1.Each task can be delete. when user click(need to create event handler) on that task.
     * 2.Send delete request to rest API to delete it in mysql database.(AJAX CALL)
     */
    $scope.deleteTask = id => {
        console.log("delete");
        request("DELETE", baseUrl+"todos/"+id, {}, (err, result) => {
            retrieveList();
        })
    };

    /**
     * TODO:
     * 1.create a form under the todo list
     * 2.user create a new todo task; send data to backend rest API
     * 3.store the new todo task in database and return the new list
     * 4.update $scope.todoList with the API returned new list
     */
    $scope.createTask = () => {
        if (!$scope.status || !$scope.task) {
            return;
        }
        const params = {
            status: $scope.status,
            task: $scope.task
        }
        request("POST", baseUrl+"todos", params, (err, result) => {
            retrieveList();
        });
    }

    /**
     * optional tasks:
     * 1.edit todo task
     */
    $scope.updateTask = id => {
        console.log("update");
        request("PUT", baseUrl+"todos/"+id, {}, (err, result) => {
            console.log("update finish");
            retrieveList();
        })
    }
});
