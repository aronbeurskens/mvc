<?php

/**
 * Project name: MVC
 * @/webist/mvc
 * @name Director.php
 * @author Webist
 * Created at : Mar 3, 2015 9:01:01 AM
 * UTF-8
 *
 */

namespace src\vendor\Webist;

class Director 
{
    /**
     * Director is the Controller of Controllers of the organization.
     *
     * - listen/accept request context (buy=post req, sell=get req)
     * - define strategy (define a choice from available alternatives) within the app
     * for result (page, response [product]) and context (market).
     *
     * - permit a procedure by sign. So listen to request and the way of work-flow (process, design-pattern?).
     * For instance using PDO tool permission.
     *
     * - watch/control and create capacity (budget) some time. Lets say every 3 days.
     * But this can be also triggered by a big request. So every new route item (in routes file) should cause
     * checking capacity check. And a new route should be added/removed by the director, not the programmer.
     * Adding/Removing a route item should be caused by the ....
     *
     * - negotiation and contraction with services. Like web services that delivers data but also services
     * those accepts output and delivers to their requests (api client & api server).
     *
     * - market watch. competetions (how much a tool is liked) and opportunities (new package check).
     *
     * - re-orginize workers and managers. (managers(controllers) should not be generated manually, but by the Director?)
     *
     * - periodical analyse by communicating the workers, managers.
     *
     * - represent the app on platforms and making introduction to others (composer image?)
     *
     * - maintain tools by repairing, buying
     *
     * - analyse app prestations by evaluations
     *
     *
     *
     * MODEL : which model to use.
     * - define context
     * - hires a mapper (planner)
     * - delegate (responsibility) Logic to a worker and let it cooperate with mapper
     * The Model that choosed by the director takes care of product (page) data, translations, navigation, logs, etc.
     *
     * TEMPLATE : which template/response to use. A template can be located at external place. front-end development.
     *
     * VIEW : Making model available(connect things) to Response generator (template).
     *
     *
     * @todo Director tasks. Pretty much every class that would normally needed from the \app\core directory.
     * //set model
     * model = Model("view")->entity('request_uri');
     *
     * //set template
     * path = Template()->path("/");
     *
     * //set view
     * View()->render(path,model);
     *
     *
     *
     *
     *
     *
     */
    //@todo ModelMapper object
    private $modelMap = [
        "view" => [
            //@Notice namespaces cannot have variables, which is good for consistent interfacing.
            "model" => "\\app\\models\\view\\model",
            "logic" => "\\app\\models\\view\\logic",
            "mapper" => "\\app\\models\\view\\mapper"
        ]
    ];

    public function model($model, $context = null)
    {
        //@Notice, having model,logic,view or not to return a module is completely in the control of the director. This allows us to make future improvements.
        return new $this->modelMap[$model]['model']($context, new $this->modelMap[$model]['logic'](), new $this->modelMap[$model]['mapper']()
        );
    }

}