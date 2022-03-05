<?php
	
	#########################################################################################
	##	{																					#
	##		"response": [{                              ---- $group_info->{'response'};		#
	##			"gid": 00000000,															#
	##			"name": "Имя заветной группы",
	##			"screen_name": "SHORT_NAME",
	##			"is_closed": 0,
	##			"type": "group",
	##			"is_admin": 0,
	##			"is_member": 0,
	##			"description": "Описание группы!",
	##			"photo": "https://pp.userap...ad7/u3apuk3nKek.jpg",
	##			"photo_medium": "https://pp.userap...ad6/jIsScXTOT5g.jpg",
	##			"photo_big": "https://pp.userap...ad5/7E-LEsUfG4k.jpg"
	##		}]
	##	}																					#	
	#########################################################################################
	
	
function groups_getById($group_ids){

	
	$GIfields = "city, country, place, description, wiki_page, members_count, counters, start_date, finish_date, can_post, can_see_all_posts, activity, status, contacts, links, fixed_post, verified, site, ban_info, cover";
	$Gid = $group_ids;
	
	// $group_json = file_get_contents('https://api.vk.com/method/groups.getById?group_ids='.$Gid.'fields='.$GIfields.'&access_token='.$userRow['token'].'' );
	$group_json = file_get_contents('https://api.vk.com/method/groups.getById?group_ids='.$Gid.'' );
	$group_arr = json_decode($group_json);
		//var_dump($group_arr);
	$group_info = $group_arr->{'response'};
		// var_dump($group_info);
	
	$gname = $group_info[0]->{'name'};
	
	
	
	print $gname;




	
}
	// groups_getById("87562343");

?>