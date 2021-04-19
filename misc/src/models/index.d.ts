import { ModelInit, MutableModel, PersistentModelConstructor } from "@aws-amplify/datastore";





export declare class Event {
  readonly id: string;
  readonly Name: string;
  readonly Date: string;
  readonly Description?: string;
  readonly location?: string;
  readonly memberID: string;
  readonly AttendedBy?: (MemberEvent | null)[];
  constructor(init: ModelInit<Event>);
  static copyOf(source: Event, mutator: (draft: MutableModel<Event>) => MutableModel<Event> | void): Event;
}

export declare class MemberEvent {
  readonly id: string;
  readonly event: Event;
  readonly member: Member;
  constructor(init: ModelInit<MemberEvent>);
  static copyOf(source: MemberEvent, mutator: (draft: MutableModel<MemberEvent>) => MutableModel<MemberEvent> | void): MemberEvent;
}

export declare class Member {
  readonly id: string;
  readonly Name: string;
  readonly PhoneNumber: string;
  readonly Email: string;
  readonly Status: string;
  readonly SideRowed?: string;
  readonly Create?: (Event | null)[];
  readonly Attend?: (MemberEvent | null)[];
  readonly Biography?: string;
  constructor(init: ModelInit<Member>);
  static copyOf(source: Member, mutator: (draft: MutableModel<Member>) => MutableModel<Member> | void): Member;
}