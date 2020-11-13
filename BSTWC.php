<?php
/**
 * Plugin Name: BSTWC_main
 * Description: Convert bootstrap studio exports to Wordpress Themes.
 */

    if (! defined('ABSPATH')){
	    die;	
    }

    if (class_exists('BSTWC')){
		$BSTWC = new BSTWC ();
		$BSTWC->register();

    }
    
    register_activation_hook(__FILE__,array($BSTWC,'activate'));
    register_deactivation_hook(__FILE__,array($BSTWC,'deactivate'));

    class BSTWC{

        public 

        function __construct(){

            add_action('admin_menu',array($this,'BSTWC_wordpress_page'));
        }

        function register(){

        }
        function activate(){
            flush_rewrite_rules();
        }
        function deactivate(){
            echo ' deactive';

        }
        function uninstall(){

        }

        function BSTWC_wordpress_page() {

            add_menu_page('BSTWC', 'BSTWC', 'publish_pages', 'BSTWC_main_BSTWC_page_slug', array($this,'build_main_BSTWC_page'),'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhLS0gQ3JlYXRlZCB3aXRoIElua3NjYXBlIChodHRwOi8vd3d3Lmlua3NjYXBlLm9yZy8pIC0tPgoKPHN2ZwogICB4bWxuczpkYz0iaHR0cDovL3B1cmwub3JnL2RjL2VsZW1lbnRzLzEuMS8iCiAgIHhtbG5zOmNjPSJodHRwOi8vY3JlYXRpdmVjb21tb25zLm9yZy9ucyMiCiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIKICAgeG1sbnM6c3ZnPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIKICAgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIgogICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiCiAgIHhtbG5zOmlua3NjYXBlPSJodHRwOi8vd3d3Lmlua3NjYXBlLm9yZy9uYW1lc3BhY2VzL2lua3NjYXBlIgogICB3aWR0aD0iMTcyLjg0MzQ0bW0iCiAgIGhlaWdodD0iMjA5LjE1NDNtbSIKICAgdmlld0JveD0iMCAwIDYxMi40Mzc0IDc0MS4wOTc5IgogICBpZD0ic3ZnMiIKICAgdmVyc2lvbj0iMS4xIgogICBpbmtzY2FwZTp2ZXJzaW9uPSIwLjkxIHIxMzcyNSIKICAgc29kaXBvZGk6ZG9jbmFtZT0iQlNUV0NfbG9nby5zdmciPgogIDxkZWZzCiAgICAgaWQ9ImRlZnM0IiAvPgogIDxzb2RpcG9kaTpuYW1lZHZpZXcKICAgICBpZD0iYmFzZSIKICAgICBwYWdlY29sb3I9IiNmZmZmZmYiCiAgICAgYm9yZGVyY29sb3I9IiM2NjY2NjYiCiAgICAgYm9yZGVyb3BhY2l0eT0iMS4wIgogICAgIGlua3NjYXBlOnBhZ2VvcGFjaXR5PSIwLjAiCiAgICAgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIKICAgICBpbmtzY2FwZTp6b29tPSIwLjM1IgogICAgIGlua3NjYXBlOmN4PSI1OTEuOTIxMjUiCiAgICAgaW5rc2NhcGU6Y3k9IjM1NC44Njc4MyIKICAgICBpbmtzY2FwZTpkb2N1bWVudC11bml0cz0icHgiCiAgICAgaW5rc2NhcGU6Y3VycmVudC1sYXllcj0ibGF5ZXIxIgogICAgIHNob3dncmlkPSJmYWxzZSIKICAgICBpbmtzY2FwZTp3aW5kb3ctd2lkdGg9IjEyODAiCiAgICAgaW5rc2NhcGU6d2luZG93LWhlaWdodD0iNjYwIgogICAgIGlua3NjYXBlOndpbmRvdy14PSItOCIKICAgICBpbmtzY2FwZTp3aW5kb3cteT0iLTgiCiAgICAgaW5rc2NhcGU6d2luZG93LW1heGltaXplZD0iMSIKICAgICBmaXQtbWFyZ2luLXRvcD0iMCIKICAgICBmaXQtbWFyZ2luLWxlZnQ9IjAiCiAgICAgZml0LW1hcmdpbi1yaWdodD0iMCIKICAgICBmaXQtbWFyZ2luLWJvdHRvbT0iMCIgLz4KICA8bWV0YWRhdGEKICAgICBpZD0ibWV0YWRhdGE3Ij4KICAgIDxyZGY6UkRGPgogICAgICA8Y2M6V29yawogICAgICAgICByZGY6YWJvdXQ9IiI+CiAgICAgICAgPGRjOmZvcm1hdD5pbWFnZS9zdmcreG1sPC9kYzpmb3JtYXQ+CiAgICAgICAgPGRjOnR5cGUKICAgICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPgogICAgICAgIDxkYzp0aXRsZT48L2RjOnRpdGxlPgogICAgICA8L2NjOldvcms+CiAgICA8L3JkZjpSREY+CiAgPC9tZXRhZGF0YT4KICA8ZwogICAgIGlua3NjYXBlOmxhYmVsPSJMYXllciAxIgogICAgIGlua3NjYXBlOmdyb3VwbW9kZT0ibGF5ZXIiCiAgICAgaWQ9ImxheWVyMSIKICAgICB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtNDUuNTgzMjY4LC0xNDYuMTMyMTIpIj4KICAgIDxwYXRoCiAgICAgICBzdHlsZT0iZmlsbDojMDAwMDAwIgogICAgICAgZD0iTSA3NS43Njc1NDMsODg1LjczOTQ3IEMgNjEuODU4MDMsODgxLjkyNDczIDUwLjQ2MzUyMiw4NzAuMTE5OTMgNDYuODg3OTg5LDg1NS44MjAwNiA0NS41ODE3MjYsODUwLjU5NTgzIDQ1LjQ0OTk2Myw4MjIuNTQ2OCA0NS42Njg5NjMsNTk2LjMyMzkxIGwgMC4yNDU1NTMsLTI1My42Mzg3NiAyLjEyNTM0OCwtNS43NDk3MSBjIDQuMTMzMTU2LC0xMS4xODE0MiAxMi45OTQ3NjIsLTIwLjExMzU1IDI0LjYzNzE5MiwtMjQuODMzMjEgNS4xMzQ3NDUsLTIuMDgxNTQgNi45NjQ4ODksLTIuMjIyODUgMzMuMTM0MjY0LC0yLjU1ODI3IGwgMjcuNjk5MzMsLTAuMzU1MDMgMCwtMjEuNTY3MTEgYyAwLC0xOC43NTg1NiAwLjI0MzU2LC0yMi4zNjY5OCAxLjg3MDI5LC0yNy43MDkzMiAzLjUwNjAzLC0xMS41MTM5MSAxMS4yNDAxNSwtMjAuNDM4NjYgMjIuMTE1MjQsLTI1LjUxOTg2IDYuNjA3MzEsLTMuMDg3MTcgMTQuMDg0MjMsLTQuMjU1OTUgMjcuMzg4NDMsLTQuMjgxMzQgbCAxMC4xODAxLC0wLjAxOTQgMC4wMDksLTIxLjAyMDYzIGMgMCwtMTEuNTYxMzUgMC40NDg0OSwtMjMuODQ3NTUgMC45ODgzNiwtMjcuMzAyNjcgMi43NzUxNSwtMTcuNzYwMzIgMTUuNjIzODUsLTMxLjQzMDU4IDMyLjY1OTkzLC0zNC43NDgzMyA0LjEzMzY4LC0wLjgwNTAzIDU4LjEwMTMyLC0xLjAyMjcxIDIwMS42NywtMC44MTM0MiBsIDE5Ni4wMjYsMC4yODU3NCA1LjIwODQyLDIuMTY3NjcgYyAxMC41MDc2Niw0LjM3MzEyIDE5LjYzMzE5LDEzLjY4NjM0IDIzLjkxODIxLDI0LjQxMDE1IGwgMi4xMjM5LDUuMzE1NTYgMC4yNzg4OCwyNTIuNzMwODYgYyAwLjIwNTUsMTg2LjI0ODU2IC0wLjAwOSwyNTQuMjU2MjYgLTAuODAxMDUsMjU4LjUyOTY1IC0zLjE0NDk0LDE2Ljg4NzQ2IC0xNi4xOTk0MiwzMC4wNzI4NCAtMzIuOTkyNDEsMzMuMzIzMDYgLTIuODAzMjcsMC41NDI1NyAtMTAuMzQwOCwwLjk4NjQ4IC0xNi43NDk5OSwwLjk4NjQ4IGwgLTExLjY1MzIzLDAgLTAuMjkxNTgsMjYuODE5NDMgLTAuMjkxNjcsMjYuODE5NDQgLTMuMTUxMzgsNi41Nzc4OSBjIC01LjQzMjI4LDExLjMzODU5IC0xNi4wNjU2MSwyMC4wOTYwMSAtMjcuNzM0MTcsMjIuODQxNDQgLTIuMjg0MTMsMC41Mzc0IC0xNS43NjUzMiwwLjk4NzcyIC0yOS45NTgyNywxLjAwMDcxIGwgLTI1LjgwNTM1LDAuMDIzNyAtMC4wMDksMTguNjA0NDcgYyAwLDEwLjIzMjQ0IC0wLjQ0MTc3LDIxLjQzMTM3IC0wLjk3MzEzLDI0Ljg4NjQ4IC0yLjY0OTk0LDE3LjIzNDM1IC0xNS40MjI5OCwzMS4wODQ5NyAtMzEuOTc0MDEsMzQuNjcxODIgLTMuNjMwNjUsMC43ODY4IC01OC44ODI2MiwxLjA2OTg3IC0xOTkuODEzOTIsMS4wMjM4NyAtMTY4LjM1NDk5LC0wLjA1NTEgLTE5NS40OTkwOTgsLTAuMjU2NiAtMTk5Ljk4MDcwNywtMS40ODU3NSB6IE0gNDc4LjQ5MDA2LDg2NS43MjAyOSBjIDUuNjcwMTcsLTMuNDAxNTggOS43MDA5MiwtOC45ODEzMSAxMS4wMTg5MywtMTUuMjUzNzcgMS4xMTQ3OSwtNS4zMDQ3NCAxLjUxMzA5LC00OTMuNjU2OCAwLjQwOTM4LC01MDEuODc0OSAtMC45NDM4NiwtNy4wMjc3MSAtNS41NTEwNCwtMTMuODgxOTUgLTExLjcwNTAyLC0xNy40MTQwNyBsIC01LjIwODQyLC0yLjk4OTM5IC0xOTYuMDUxMTcsMCAtMTk2LjA1MTI4MywwIC00LjcwMDkzMSwyLjQ2ODkzIGMgLTUuMzUxNzkzLDIuODEwNzggLTEwLjM2MDk2OCw4LjkxMTI5IC0xMS44MDIxODUsMTQuMzczNDcgLTAuNjY2Mjk5LDIuNTI1NDMgLTAuOTAxODE1LDg0LjIzNDQ4IC0wLjczNTk5NywyNTUuMzQ4IDAuMjM1ODk0LDI0My40MDgwMyAwLjMwMTYxNCwyNTEuNzQ0NzcgMi4wMDkyMTksMjU1LjAxNjg0IDMuMzE0NjM4LDYuMzUxMjYgOC4yOTA4NTgsMTAuNTk4NCAxNC44MDA4MTUsMTIuNjMyMjMgMS4zMDU0MiwwLjQwNzg1IDkwLjM3MjE1MiwwLjY2ODAyIDE5Ny45MjYwMzIsMC41NzgyNCBsIDE5NS41NTI0OCwtMC4xNjMxNCA0LjUzODE1LC0yLjcyMjQ0IHogbSA4OC4zMTg1MiwtNzkuNDUyOCBjIDIuODY4ODksLTEuODExMyA1LjcyMzk2LC00LjcyNjIyIDcuNDk4OCwtNy42NTU4OCBsIDIuODY1OTUsLTQuNzMwOTQgMC4yNzczOCwtMjUyLjgwNjcgYyAwLjE5OTYyLC0xODEuOTgxMTMgLTAuMDE1MiwtMjUzLjgzODkgLTAuNzY1OTMsLTI1Ni40OTEwMyAtMS4zODIwMywtNC44ODExMiAtNy4wMTM5NCwtMTEuMTIxOTggLTEyLjI5NTc1LC0xMy42MjUyOCBsIC00LjI2MTQ0LC0yLjAxOTcxIC0xOTIuNzExNTUsLTAuMjU2NDggYyAtMTM2LjM4MDM3LC0wLjE4MTUxIC0xOTQuMTcwNTQsMC4wNTE2IC0xOTcuNzAyOTksMC43OTc1NSAtNi43Mjk5NCwxLjQyMTE3IC0xMi4zNTc3OCw1LjkwOTA4IC0xNS42MDU0NywxMi40NDQ1NCBsIC0yLjYwNDIxLDUuMjQwNjEgMCwyMS4wODg5NSAwLDIxLjA4ODk1IDE1OS4zMzAyOSwwLjAxNDMgYyAxNzMuOTQ2MzcsMC4wMTU2IDE2NS43NTg1NCwtMC4yNDAxIDE3Ni4wOTA3Miw1LjQ5OTA0IDEwLjU0OTMzLDUuODU5NzcgMTguNzAyMDIsMTcuODIyODggMjAuNjEyMjgsMzAuMjQ1OTEgMC42MzU1Miw0LjEzMzEgMC45NjgzOSw4MS4yNjUyOCAwLjk3MzEyLDIyNS40ODM0IGwgMC4wMDksMjE5LjIwMTM1IDI2LjgyOTQzLC0wLjI5NjgyIDI2LjgyOTMzLC0wLjI5NjgyIDQuNjMyOTMsLTIuOTI0OTUgeiBtIDYwLjU3NTA2LC04My42MjY1MyBjIDUuMzQ4MSwtMi44MTA5NCAxMC4zNTgzMiwtOC45MTQ1MiAxMS43OTg1OSwtMTQuMzczNDYgMC42NjYzLC0yLjUyNTQ0IDAuOTAxODEsLTg0LjIzNDQ4IDAuNzM2LC0yNTUuMzQ4IC0wLjIzNTgsLTI0My40MDgwNyAtMC4zMDE1MiwtMjUxLjc0NDc1IC0yLjAwOTEzLC0yNTUuMDE2OCAtMi40NzA3OCwtNC43MzQ0IC02LjExMzE3LC04LjUyMDM1IC0xMC41NDU1MywtMTAuOTYxMjUgbCAtMy43ODc5NSwtMi4wODYwNCAtMTk0Ljk0NDY0LC0wLjI1MDc0IGMgLTEzMi4zMzgsLTAuMTcwMjEgLTE5Ni4xMTUzNiwwLjA3MSAtMTk4LjU5MDMxLDAuNzUxMTUgLTUuMzU1MDEsMS40NzE2MyAtMTEuMzM1MDQsNi41ODI2NCAtMTQuMDkwNTgsMTIuMDQyOTkgLTIuMzcyNTcsNC43MDE1NyAtMi40MjUxMyw1LjI1NDgxIC0yLjcyODc0LDI4Ljc0MzQ0IGwgLTAuMzA5NTcsMjMuOTQ5NjEgMTcwLjc2Njk0LDAuMDE5MSBjIDEwNy4yMzE2MiwwLjAxMiAxNzMuMTcyMTEsMC4zNzQwMSAxNzcuMjMxMTgsMC45NzI5NSAxMy40Nzk0OSwxLjk4ODkyIDI0LjU0NzY2LDEwLjI3MDAxIDMwLjY5NjI1LDIyLjk2NjU1IGwgMy41NTk5MSw3LjM1MDk5IDAuMjM2MjcsMjIwLjg4NzczIGMgMC4xMjk4MywxMjEuNDg4MjUgMC40NTE3MSwyMjEuNDczMDMgMC43MTUyNiwyMjIuMTg4MzggMC4zNzgwNCwxLjAyNjEyIDMuMjMyNDQsMS4yMzAxMSAxMy41MjM5LDAuOTY2NDYgMTEuNzcyMDcsLTAuMzAxNTcgMTMuNTAyOTcsLTAuNTc1MDQgMTcuNzQyMTUsLTIuODAzMTEgeiIKICAgICAgIGlkPSJwYXRoNDI3NSIKICAgICAgIGlua3NjYXBlOmNvbm5lY3Rvci1jdXJ2YXR1cmU9IjAiIC8+CiAgICA8cGF0aAogICAgICAgc3R5bGU9ImZpbGw6IzAwMDAwMCIKICAgICAgIGQ9Ik0gMjE4LjQyMDQ0LDc3Mi41NTkyMiBDIDgzLjI2OTk0Myw3MjguMjQ0MTUgNDAuMjMzNTQzLDU1OC4zMzE0NiAxMzkuNDg4MjQsNDYwLjkyNTEgYyA0MC41ODkyLC0zOS44MzM0NiA2OC44NTY1LC01MC42ODE3NSAxMzIuMDYwOCwtNTAuNjgxNzUgNjMuMjA0MywwIDkxLjQ3MTcsMTAuODQ4MjkgMTMyLjA2MDksNTAuNjgxNzUgODkuNDMyNSw4Ny43Njc2MiA2NC4zNjc1LDI0MC40NDQ5NyAtNDkuMTE0NywyOTkuMTY3MzggLTI4Ljg1OTMsMTQuOTMzNDMgLTEwNi43ODAyLDIyLjA3MjMgLTEzNi4wNzQ4LDEyLjQ2Njc0IHogbSAxMDguMTA3MywtMjQuNTk2MDUgYyA2NC40ODcsLTIxLjk3Mjg5IDEwNy4xOTk2LC04My44ODkzOSAxMDcuMTk5NiwtMTU1LjM5NzU5IDAsLTExNS42ODQ5IC0xMDcuNjQxNSwtMTkyLjcxMzI2IC0yMTcuMTU3LC0xNTUuMzk3NTggLTY0LjQ4NjksMjEuOTcyODkgLTEwNy4xOTk1LDgzLjg4OTM5IC0xMDcuMTk5NSwxNTUuMzk3NTggMCwxMTUuNzY0MDcgMTA3LjU2NjUsMTkyLjczODgxIDIxNy4xNTY5LDE1NS4zOTc1OSB6IG0gLTc3LjA2NjIsLTcuODQ0NTggYyAtMTAuODUsLTEuNDc0MDUgLTE3LjU1OTQsLTUuODQyNDYgLTE1LjkwMTEsLTEwLjM1MzU0IDEuNTc3MywtNC4yOTE4OSA5LjY0NjksLTI4LjcwNTkzIDE3LjkzMTYsLTU0LjI1MzMzIDguMjg1MywtMjUuNTQ3NDEgMTcuMjEzNiwtNDguODE5OTEgMTkuODQxNCwtNTEuNzE2NTkgMi42MjcsLTIuODk2NzQgMTQuMTQ5MywxOS40MDIwMyAyNS42MDQ1LDQ5LjU1Mjc1IDExLjQ1NTEsMzAuMTUwNzIgMTguNjQwMyw1Ni43NjA5IDE1Ljk2NzQsNTkuMTMzNzYgLTcuMTc2NSw2LjM3MDg2IC00MS45NTE1LDEwLjU1Njg1IC02My40NDM4LDcuNjM2OTUgeiBtIC04My44MjIxLC00MS4xMjA2NCBjIC0zMy40MDM0LC0zMy40MDMxNCAtNTAuNjUyMiwtODYuNTUyNSAtNDIuMzU2OSwtMTMwLjUxNDYxIDMuMDc5NiwtMTYuMzIwOTUgOC41ODUyLC0yOC45NzQ2OCAxMi4yMzQ5LC0yOC4xMTk0MSA1LjYyMTEsMS4zMTczMiA2OC45NywxNjUuMzQwODQgNjkuNDk1NiwxNzkuOTM4NyAwLjQxMTQsMTEuNTE2NDQgLTE0Ljc2NzEsMy4zMDE3MiAtMzkuMzczNiwtMjEuMzA0NjggeiBtIDE5OC4zNTI4LC0zMS43ODA4NSBjIDEwLjUxNDksLTI4LjI4NDYzIDIyLjM4MzUsLTU5LjgzMjY5IDI2LjM3NjIsLTcwLjEwNjczIDMuOTkyLC0xMC4yNzQwNCA3LjI1ODgsLTMwLjQyOTk1IDcuMjU4OCwtNDQuNzkwOTEgMCwtMzcuMjU5MjcgMTAuOTQ0MiwtMzIuMjU2NjkgMjAuMjMyOCw5LjI0ODM2IDEwLjQwNTUsNDYuNDk4OCAtMy44NTkzLDk5LjM1NTg2IC0zNi4wMTU4LDEzMy40NTIxIC0zNC40MTc0LDM2LjQ5MjU4IC0zOS4wNjMsMjkuMjU3MjIgLTE3Ljg1MiwtMjcuODAyODIgeiBtIC0xMzkuNjgwNywtNi42MzU2OSBjIC0yMi43MTQ2LC01OC40MjUyIC00NS42NjIxLC0xMjIuODQ3MiAtNDUuNjYyMSwtMTI4LjE4OTczIDAsLTMuNDAwNjYgNC40NzkxLC02LjE4MyA5Ljk1MzUsLTYuMTgzIDIyLjg3ODUsMCA3LjcwOCwtMTIuNjc1NyAtMTcuNDEyLC0xNC41NDg3NSBsIC0yNy4zNjUsLTIuMDQwNDggMTguOTgzNCwtMTguOTE1MjMgYyA1NC4zOTAxLC01NC4xOTM1NiAxNDMuMDgzNCwtNjEuMzE2MjQgMTk5Ljg0NzgsLTE2LjA0OTE1IDYuMjI2OSw0Ljk2NTQyIDQuODQzNCw5LjE5NjM0IC01LjgzMzUsMTcuODQyMTEgbCAtMTMuOTk2LDExLjMzMzIzIDE0LjEyODEsMzEuOTM5NzcgYyA3Ljc3MSwxNy41NjY3OSAxNC4xMjg3LDM4LjQ4MzI5IDE0LjEyODcsNDYuNDgxMDIgMCwxOS42MTYxNiAtMTkuMjM1NSw4My4zMTkwNiAtMjUuMTQwNiw4My4yNTg4IC0yLjU5NTksLTAuMDI2NSAtMTUuNjk2OCwtMzEuMzgwMTggLTI5LjExMjEsLTY5LjY3NDc1IC0xOC42NzM1LC01My4zMDI1MSAtMjIuMTc0NSwtNjkuNjI2NTcgLTE0LjkzMDQsLTY5LjYyNjU3IDUuMjAzOCwwIDkuNDYxOSwtNC4xMDU4NCA5LjQ2MTksLTkuMTI0MDggMCwtNi44MDU4MyAtMTAuOTU4OSwtOS4xMjQwNyAtNDMuMTMyLC05LjEyNDA3IC0zMC4yMzQ5LDAgLTQzLjEzMiwyLjQ5NjgxIC00My4xMzIsOC4zNTAxNSAwLDQuNTkyNTYgNS4zNDc3LDkuNzQ4NjkgMTEuODg0NSwxMS40NTgwNSA2LjgwNDksMS43Nzk0OSAxNS44MjAyLDE1LjAzMzE2IDIxLjA5MjksMzEuMDA4NzEgOC40MDg3LDI1LjQ4MDEzIDcuOTIwNCwzMS44OTg1IC01LjYzMTcsNzMuOTc2NDcgLTguMTYxOSwyNS4zNDE2NCAtMTYuMjM0Miw0Ni4wNzU2NSAtMTcuOTM4OSw0Ni4wNzU2NSAtMS43MDQ4LDAgLTYuMjkyLC04LjIxMTY3IC0xMC4xOTQ1LC0xOC4yNDgxNSB6IgogICAgICAgaWQ9InBhdGg0Mjg4IgogICAgICAgaW5rc2NhcGU6Y29ubmVjdG9yLWN1cnZhdHVyZT0iMCIgLz4KICA8L2c+Cjwvc3ZnPgo=',1);
            // add_submenu_page ( 'BSTWC_main_BSTWC_page_slug', 'BSTWC Edit talent','Edit Talent', 'manage_options', 'edit_talent', 'build_edit_talent_page' );

            add_submenu_page ( 'BSTWC_main_BSTWC_page_slug', 'BSTWC Add talent','Find bootstrap export', 'manage_options', 'Find bootstrap export', array($this,'build_converter_UI') );

            remove_submenu_page('BSTWC_main_BSTWC_page_slug','BSTWC_main_BSTWC_page_slug');
        
        }

        function BSTWC_search_theme_dir_for_bootstrap_export(){
            
            require_once("../wp-load.php");
            $path =get_theme_root();
            $themedirs = array_diff(scandir($path), array('..', '.'));

            foreach ($themedirs as $key => $themedir) {

                if (is_dir($path.'/'.$themedir )) {

                    chdir($path.'/'.$themedir);

                    if (!file_exists ( "style.css" )) {//crude check to determine if a directory is already wordpress theme.

                        $msg = "";

                        if (file_exists ($path.'/'.$themedir.'/index.html' )) {

                            $html = implode('', file($path.'/'.$themedir.'/index.html'));
                            
                            if (strpos($html, 'bootstrap/css/bootstrap.min.css') !== false) {
                                echo  "<p>The <b>".$themedir."</b> directory  uses bootstrap. </p><p>Click the button to start converting...</p>";      
                                
                                //place a button on the BSTWC_wordpress_page that when clicked will start the parsing process.note: themedir becomes the newthemename
                                echo '
                                    <form action="" method="post">
                                        <button type="submit" value="'.$path.'/'.$themedir.'" name="thisdir">'.$themedir.'</button>
                                        <input type="hidden" name="themedir" value="'.$themedir.'"/>
                                    </form>
                                ';
                            }
                        }
                        else{
                            echo  "<p>The <b>".$themedir."</b> directory does not appear to use bootstrap. </p>";
                        }
                    }                    
                    else{
                        echo "<p>The <b>".$themedir."</b> directory is a WordPress theme</p>";
                    }
                }
            }
        }

        function build_converter_UI() {
            
            $this->BSTWC_search_theme_dir_for_bootstrap_export();//activate on page open..

            if(isset($_POST['thisdir'])){

                $GLOBALS["newthemename"] = $_POST['themedir'];
                $result = $this->chopup_that_index($_POST['thisdir'],$GLOBALS["newthemename"]);
            }    
        }

        function chopup_that_index($current_directory, $newthemename){

            $html = implode('', file($current_directory.'/index.html'));

            //convert the uri's to work in the wordpress environment. add wordpress elements.

            $html = str_replace("assets/", "<?php echo get_theme_root_uri(); ?>/".$newthemename."/assets/", $html);

            $html = str_replace("<body ", "<body <?php body_class(); ?>", $html);
            
            $html = str_replace("<body>", "<body <?php body_class(); ?>>", $html);
            
            $html = str_replace("</head>", "<?php wp_head();?></head>", $html);

            $html = str_replace("</body>", "<?php wp_footer(); ?></body>", $html);
            
            $phpnav = 	"<?php 
                    wp_nav_menu( array(
                        'theme_location'  => 'primary',
                        'depth'           => 2,
                        'container'       => 'li',
                        'container_class' => 'nav-item nav-link',
                        'container_id'    => '',
                        'menu_class'      => 'nav navbar-nav ml-auto',
                        'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'          => new WP_Bootstrap_Navwalker(),
                    ) ); 
                ?>" ;

            // split html in pieces on each nav start
            $cutnav = explode("<nav", $html);
                
            //echo '<script>console.log('. json_encode( count($cutnav)) .')</script>';
            echo '<script>console.log('. json_encode( $cutnav) .')</script>';

            //get the first part of the html (up to '<nav') and put it in the new array htmlsplit
            $cutnavarray[0] =  $cutnav[0];
            //for all nav start sections of html split on nav end
            for ($i=1; $i < count($cutnav) ; $i++) { 
                    $cutnavarray[$i] = explode("</nav>", $cutnav[$i]);
            }

            //echo '<script>console.log('. json_encode( $cutnavarray) .')</script>';

            //get the begining of the html to the start of the first nav.
            $begining = $cutnavarray[0];

            //cut the begining out of the array so the array holds only arrays of 2 elememts the first being the nav section
            //and thw second being the html from the end nav to the start of the nav of the next navgation.  
            array_splice($cutnavarray,0,1);

            for ($k=0; $k< count($cutnavarray); $k++) { 

                //get the nav section and reapply the nav tags 
                $join = array('<nav', $cutnavarray[$k][0], '</nav>');
                
                //store the complete navs 
                $nav_sections[$k] = implode("",$join);
                $cutnavarray[$k][0]=$nav_sections[$k];
            }

            //get elements and stick them back together in string
            foreach ($cutnavarray as $arrayof_nav_and_next_section ) {
                $nav_and_next_section[]=implode("",$arrayof_nav_and_next_section);
            }

            $all_navs_and_sections[]=implode("",$nav_and_next_section);

            // add 
            array_unshift($all_navs_and_sections , $begining);

            $rebuilt_html=implode("",$all_navs_and_sections);

            //get the html from the cut out nav and extract the urls to files and the names used for the links. 
            $menunum=0;

            foreach ($nav_sections as $nav_section) {

                $doc = new DOMDocument();
                $doc->loadHTML($nav_section);
                $links = $doc->getElementsByTagName('a');
                $pages_names = [];

                foreach ($links as $link ) {

                    $pages_names[] = $link->textContent;
                    //remove targets from the hrefs
                    $href = $link->getAttribute("href");
                    $pos = strpos($href,'#');
                    $len = strlen($href);

                    if ($pos !== false) {

                        $href = substr($href,0,$pos);
                    }

                    $pages_hrefs[] = $href;
                }

                $menunum++;

                //make a name for a new menu 
                $menu_name = basename($current_directory).'-'.$menunum; 
                $dir = basename($current_directory);
                $built = $this->buildmenu( $current_directory , $menu_name , $pages_names , $pages_hrefs , $rebuilt_html);
                
                unset($pages_names);
                unset($pages_hrefs);
                
                //find the ul part of the nav_section and replace with wordpress menu/
                $cutul = explode("<ul", $nav_section);
                $cutul2 = explode("</ul>", $cutul[1]);
                
                $rebuilt_html = str_replace('<ul'.$cutul2[0].'</ul>', $this->phpnav($menu_name), $rebuilt_html);
                unset($cutul);
                unset($cutul2);

            }

            //split the html on the string '</header>'
            $split1 = explode("</header>", $rebuilt_html);

            // if morethan one nav(the array holds more then two elements)use the last element to split for the main section.
             //get the last part of the split for the footer

            $split2 = explode("<footer", $split1[count($split1)-1]);

            $header = fopen($current_directory."/header.php", "w") or die("Unable to open file!");
            fwrite($header, "");
            fwrite($header, $split1[0]);
            fwrite($header, "</header>");
            fclose($header);

            $index = fopen($current_directory."/index.php", "w") or die("Unable to open file!");
            fwrite($index, "<?php get_header();?>");
            fwrite($index, $this->theloop());  //$split2[0]);
            fwrite($index, "<?php get_footer();?>");
            fclose($index);

            $footer = fopen($current_directory."/footer.php", "w") or die("Unable to open file!");
            fwrite($footer, "<footer");
            fwrite($footer, $split2[1]);
            fclose($footer);

            $stylecontent = "/*
            Theme Name: ".basename($current_directory)."
            Theme URI: https://".basename($current_directory).".com
            Author: phpiil
            Author URI: https://".basename($current_directory).".com
            Description:description.
            Version: 2.2
            License: GNU General Public License v2 or later
            License URI: http://www.gnu.org/licenses/gpl-2.0.html
            Text Domain: ".basename($current_directory)."
            Tags: one-column
            */"; 

            $stylecss = fopen($current_directory."/style.css", "w") or die("Unable to open file!");
            fwrite($stylecss, $stylecontent);
            fclose($stylecss);

            $functioncontent = "
                <?php   
                    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';  
                    add_theme_support( 'post-thumbnails' );
                    function register_my_menus() {
                        register_nav_menus(
                            array(
                                ".$this->getmenus($menu_name)."
                        
                            )
                        );
                    }
                    add_action( 'init', 'register_my_menus' );
                
                ?>"; 

            $functionphp = fopen($current_directory."/functions.php", "w") or die("Unable to open file!");
            fwrite($functionphp, $functioncontent);
            fclose($functionphp);

            if (!copy(plugin_dir_path(__FILE__).'class-wp-bootstrap-navwalker.php', $current_directory.'/class-wp-bootstrap-navwalker.php')) {
                
                echo "failed to copy $current_directory...\n";
            }
            else {
                
                echo '<p><b>done!!</b></p>';
            }

            return 'completed';
        }

        function build_main_BSTWC_page() {

            //include 'build_main_BSTWC_page.php';//this is the parents page which has been removed.
        }

        function buildmenu($basedir , $menu_name , $pages_names , $pages_hrefs , $rebuilt_html){

            $menu_id = wp_create_nav_menu($menu_name);

            for ($i=0; $i < count($pages_names); $i++) { 

                //make the wordpress pages based on the links
                //check if page exisits
                if ( get_page_by_title( $pages_names[$i] ) == null ) {
                    
                    $main_page_content = $this->get_main_content_from_pages($basedir , $pages_hrefs[$i] , $pages_names[$i] , $rebuilt_html);
                    
                    $postid = 0;

                    $this->create_update_post($postid , $pages_names[$i] , $main_page_content,$pages_hrefs[$i]);

                    wp_update_nav_menu_item($menu_id, 0, array(
                        'menu-item-title' =>  __($pages_names[$i]),
                        'menu-item-classes' => 'xxx',
                        'menu-item-url' => home_url( '/'.$pages_hrefs[$i] ), 
                        'menu-item-status' => 'publish'));
                }  
                else{

                    $post = get_page_by_title( $pages_names[$i]);
                    $main_page_content = $this->get_main_content_from_pages($basedir , $pages_hrefs[$i] ,$pages_names[$i] , $rebuilt_html);
                    $postid = $post->ID;
                    $this->create_update_post($postid,$pages_names[$i], $main_page_content,$pages_hrefs[$i]);
                }
            }
        }

        function get_main_content_from_pages($basedir , $pages_hrefs , $pages_names , $rebuilt_html){
            
            if (file($basedir.'/'.$pages_hrefs)) {

                $page_html = implode('', file($basedir.'/'.$pages_hrefs));            
                
                $split1 = explode("</header>", $page_html);//so now $split1[1] contains the from the end of the header down////echo '<script>console.log('. json_encode( $page_html) .')</script>';
                
                //get the last part of the split for the footer !!!if there is more than one header :::$split1[count($split1)-1]
                $split2 = explode("<footer", $split1[1]);//so now $split2[0] contains the main section

                $loc_temp_dir = get_theme_root_uri()."/".$GLOBALS["newthemename"]."/";
                
                //$main_page_content = $split2[0];
                $loc = $loc_temp_dir."assets/";

                $main_page_content = str_replace("assets/",$loc,$split2[0]);
                 
            }
            else{

                $main_page_content ="no content from page";
            };

            return $main_page_content;
        }
            
        function create_update_post($postid,$posttitle,$postcontent,$postname){

            //if (file_exists($file)) {
                $my_post = array(
                    'ID'    => $postid,
                    'post_title'    => $posttitle,
                    'post_content'  => $postcontent,
                    'post_status'   => 'publish',
                    'post_author'   => 1,
                    'post_type'     => 'page',
                    // 'post_category' => array( 8,39 ),
                    'post_name'     => $postname,
                );

                // Insert the post into the database.
                $homepage_id = wp_insert_post( $my_post );

                //make the home page the first
                if ($posttitle ==='Memorial weights') {
                    update_option('show_on_front', 'page');
                    update_option('page_on_front', $homepage_id);
                }
                
            //}
        }


        function theloop(){

            $loop = "		
            
            <?php if ( has_post_thumbnail() ):   the_post_thumbnail('large')?>
		
            <?php else:?>
            
            <?php endif;  ?>  

            <?php if (have_posts()) :?>  

                <?php while (have_posts()) : the_post();?> 

                    
                        <!--<main> <h3 class='margin'><a href='<?php the_permalink();?>'><?php  the_title();?></a></h3></main> -->
                        <?php the_content();?>
                    
                <?php endwhile; ?> 

            <?php else : ?>       
                <h2 class='center'>Not Found</h2><p class='center'>Sorry, nothing here!</p>
                
                <?php get_search_form(); ?> 

		    <?php endif; ?>";
            return $loop;
        }

        function getmenus($menu_name){
                
            // for ($i=1; $i < 3; $i++) { 
            //     $menus[] = "'".$name."-".$i."' => __( '".$name."-".$i."' ),";
            // }
            //return implode("",$menus);
            return "'".$menu_name."' => __( '".$menu_name."' ),";
        }

        function phpnav($navname){
            
            $phpnav = 	"<?php 
                wp_nav_menu( array(
                    'theme_location'  => '$navname',
                    'depth'           => 2,
                    'container'       => 'li',
                    'container_class' => 'nav-item nav-link',
                    'container_id'    => '',
                    'menu_class'      => 'nav navbar-nav ml-auto',
                    'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'          => new WP_Bootstrap_Navwalker(),
                ) ); 
            ?>" ;

            return $phpnav;
        }
    }   
?>
