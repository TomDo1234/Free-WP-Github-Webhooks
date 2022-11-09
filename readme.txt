=== Free WP Github Webhooks ===
Contributors: tomdo
Tags: git, WordPress, Github, Webhooks , CI/CD , Headless Wordpress
Requires at least: 5.0.0
Tested up to: 6.1
Stable tag: 1.0.0
License: GNU GENERAL PUBLIC LICENSE
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Run a Github auto build webhook every post update and creation

== Description ==

This is a free plugin and allows you to automate your github builds to Headless Wordpress, there is another popular webhook plugin for wordpress but you have to use the paid PRO version
in order to send post variables on that... meaning you can't use it for Github workflow_dispatch because the "ref" post content variable is required and since the other popular webhook
plugin for wordpress doesn't allow you to set post content variables without going PRO, you essentially need to pay to use it with Github Actions.

