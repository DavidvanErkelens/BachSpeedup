import discogs_client
import configparser
import time


if __name__ == "__main__":
    config = configparser.ConfigParser()
    config.read('Secrets/bach/discogs.ini')

    # print(config['discogs_config']['key'])

    d = discogs_client.Client('BachSpeedup/0.1', user_token=config['discogs_config']['usertoken'])
    
    results = d.search('BWV 1051', type='release')

    i = 0


    bachs = {}


    for res in results:

        print(res.data['resource_url'])

        # break

        # print(res.year)

        # print(res.tracklist[0].title)
        # break

        # print(res.artists)
        
        time.sleep(0.25)

        # track = res.tracklist[0]



        # if track.duration == "":
        #     continue

        # if res.year == 0:
        #     continue



        # for track in res.tracklist:
        #     print(track.title + "  " + track.duration)
        # # # print(res.tracklist[0].duration)
        # # print(str(res.year) + ", " + str(track.duration) + ", " + res.title)

        # i += 1

        # if i > 10:
        #     break

    # print(results[0])