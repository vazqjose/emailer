<?php

				$msg .= "<div class='alert alert-danger' role='alert'>";
				$msg .= "";
				$msg .= "<h4><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> ".count($errors)." errors found: </h4>";
				$msg .= "<ul>";

				for ($i=0; $i < count($errors); $i++)
				{
					$msg .= "<li>".$errors[$i]."</li>";
				}
				
				$msg .= "</ul>";
				$msg .= "</div>";
?>