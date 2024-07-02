<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScopesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scopes')->insert([
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'alliances', 'name' => 'esi-alliances.read_contacts.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'assets', 'name' => 'esi-assets.read_assets.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'assets', 'name' => 'esi-assets.read_corporation_assets.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'bookmarks', 'name' => 'esi-bookmarks.read_character_bookmarks.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'bookmarks', 'name' => 'esi-bookmarks.read_corporation_bookmarks.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'calendar', 'name' => 'esi-calendar.read_calendar_events.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'calendar', 'name' => 'esi-calendar.respond_calendar_events.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_agents_research.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_blueprints.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_contacts.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_corporation_roles.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_fatigue.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_fw_stats.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_loyalty.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_medals.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_notifications.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_opportunities.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_standings.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.read_titles.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characters', 'name' => 'esi-characters.write_contacts.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'characterstats', 'name' => 'esi-characterstats.read.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'clones', 'name' => 'esi-clones.read_clones.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'clones', 'name' => 'esi-clones.read_implants.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'contracts', 'name' => 'esi-contracts.read_character_contracts.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'contracts', 'name' => 'esi-contracts.read_corporation_contracts.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_blueprints.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_contacts.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_container_logs.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_corporation_membership.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_divisions.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_facilities.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_fw_stats.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_medals.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_standings.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_starbases.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_structures.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.read_titles.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'corporations', 'name' => 'esi-corporations.track_members.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'fleets', 'name' => 'esi-fleets.read_fleet.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'fleets', 'name' => 'esi-fleets.write_fleet.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'industry', 'name' => 'esi-industry.read_character_jobs.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'industry', 'name' => 'esi-industry.read_character_mining.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'industry', 'name' => 'esi-industry.read_corporation_jobs.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'industry', 'name' => 'esi-industry.read_corporation_mining.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'killmails', 'name' => 'esi-killmails.read_corporation_killmails.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'killmails', 'name' => 'esi-killmails.read_killmails.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'location', 'name' => 'esi-location.read_location.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'location', 'name' => 'esi-location.read_online.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'location', 'name' => 'esi-location.read_ship_type.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'mail', 'name' => 'esi-mail.organize_mail.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'mail', 'name' => 'esi-mail.read_mail.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'mail', 'name' => 'esi-mail.send_mail.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'markets', 'name' => 'esi-markets.read_character_orders.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'markets', 'name' => 'esi-markets.read_corporation_orders.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'markets', 'name' => 'esi-markets.structure_markets.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'planets', 'name' => 'esi-planets.manage_planets.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'planets', 'name' => 'esi-planets.read_customs_offices.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'search', 'name' => 'esi-search.search_structures.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'skills', 'name' => 'esi-skills.read_skillqueue.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'skills', 'name' => 'esi-skills.read_skills.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'ui', 'name' => 'esi-ui.open_window.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'ui', 'name' => 'esi-ui.write_waypoint.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'universe', 'name' => 'esi-universe.read_structures.v1'],
            ['created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'key' => 'wallet', 'name' => 'esi-wallet.read_corporation_wallets.v1']
        ]);
    }
}
