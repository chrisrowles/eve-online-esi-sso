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
            ['access' => 'all', 'key' => 'alliances', 'name' => 'esi-alliances.read_contacts.v1'],
            ['access' => 'all', 'key' => 'assets', 'name' => 'esi-assets.read_assets.v1'],
            ['access' => 'all', 'key' => 'assets', 'name' => 'esi-assets.read_corporation_assets.v1'],
            ['access' => 'all', 'key' => 'bookmarks', 'name' => 'esi-bookmarks.read_character_bookmarks.v1'],
            ['access' => 'all', 'key' => 'bookmarks', 'name' => 'esi-bookmarks.read_corporation_bookmarks.v1'],
            ['access' => 'all', 'key' => 'calendar', 'name' => 'esi-calendar.read_calendar_events.v1'],
            ['access' => 'all', 'key' => 'calendar', 'name' => 'esi-calendar.respond_calendar_events.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_agents_research.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_blueprints.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_contacts.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_corporation_roles.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_fatigue.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_fw_stats.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_loyalty.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_medals.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_notifications.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_opportunities.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_standings.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.read_titles.v1'],
            ['access' => 'all', 'key' => 'characters', 'name' => 'esi-characters.write_contacts.v1'],
            ['access' => 'all', 'key' => 'characterstats', 'name' => 'esi-characterstats.read.v1'],
            ['access' => 'all', 'key' => 'clones', 'name' => 'esi-clones.read_clones.v1'],
            ['access' => 'all', 'key' => 'clones', 'name' => 'esi-clones.read_implants.v1'],
            ['access' => 'all', 'key' => 'contracts', 'name' => 'esi-contracts.read_character_contracts.v1'],
            ['access' => 'all', 'key' => 'contracts', 'name' => 'esi-contracts.read_corporation_contracts.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_blueprints.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_contacts.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_container_logs.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_corporation_membership.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_divisions.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_facilities.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_fw_stats.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_medals.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_standings.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_starbases.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_structures.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.read_titles.v1'],
            ['access' => 'all', 'key' => 'corporations', 'name' => 'esi-corporations.track_members.v1'],
            ['access' => 'all', 'key' => 'fleets', 'name' => 'esi-fleets.read_fleet.v1'],
            ['access' => 'all', 'key' => 'fleets', 'name' => 'esi-fleets.write_fleet.v1'],
            ['access' => 'all', 'key' => 'industry', 'name' => 'esi-industry.read_character_jobs.v1'],
            ['access' => 'all', 'key' => 'industry', 'name' => 'esi-industry.read_character_mining.v1'],
            ['access' => 'all', 'key' => 'industry', 'name' => 'esi-industry.read_corporation_jobs.v1'],
            ['access' => 'all', 'key' => 'industry', 'name' => 'esi-industry.read_corporation_mining.v1'],
            ['access' => 'all', 'key' => 'killmails', 'name' => 'esi-killmails.read_corporation_killmails.v1'],
            ['access' => 'all', 'key' => 'killmails', 'name' => 'esi-killmails.read_killmails.v1'],
            ['access' => 'all', 'key' => 'location', 'name' => 'esi-location.read_location.v1'],
            ['access' => 'all', 'key' => 'location', 'name' => 'esi-location.read_online.v1'],
            ['access' => 'all', 'key' => 'location', 'name' => 'esi-location.read_ship_type.v1'],
            ['access' => 'all', 'key' => 'mail', 'name' => 'esi-mail.organize_mail.v1'],
            ['access' => 'all', 'key' => 'mail', 'name' => 'esi-mail.read_mail.v1'],
            ['access' => 'all', 'key' => 'mail', 'name' => 'esi-mail.send_mail.v1'],
            ['access' => 'all', 'key' => 'markets', 'name' => 'esi-markets.read_character_orders.v1'],
            ['access' => 'all', 'key' => 'markets', 'name' => 'esi-markets.read_corporation_orders.v1'],
            ['access' => 'all', 'key' => 'markets', 'name' => 'esi-markets.structure_markets.v1'],
            ['access' => 'all', 'key' => 'planets', 'name' => 'esi-planets.manage_planets.v1'],
            ['access' => 'all', 'key' => 'planets', 'name' => 'esi-planets.read_customs_offices.v1'],
            ['access' => 'all', 'key' => 'search', 'name' => 'esi-search.search_structures.v1'],
            ['access' => 'all', 'key' => 'skills', 'name' => 'esi-skills.read_skillqueue.v1'],
            ['access' => 'all', 'key' => 'skills', 'name' => 'esi-skills.read_skills.v1'],
            ['access' => 'all', 'key' => 'ui', 'name' => 'esi-ui.open_window.v1'],
            ['access' => 'all', 'key' => 'ui', 'name' => 'esi-ui.write_waypoint.v1'],
            ['access' => 'all', 'key' => 'universe', 'name' => 'esi-universe.read_structures.v1'],
            ['access' => 'all', 'key' => 'wallet', 'name' => 'esi-wallet.read_corporation_wallets.v1']
        ]);
    }
}
